#!/bin/bash

# Variables
PROJECT_DIR="/projects/trading-app"  # Path to your Laravel project
LOG_FILE="$PROJECT_DIR/worker.log"
WORKERS=1                            # Number of queue workers to start
WORKER_PIDS=()                       # Array to hold worker PIDs

# Check if a queue name is provided
if [ -z "$1" ]; then
    echo "Usage: $0 <queue-name>"
    exit 1
fi

QUEUE_NAME=$1                        # Get queue name from the first argument

# Function to stop all workers
cleanup() {
    # echo "Stopping all workers..."
    # for PID in "${WORKER_PIDS[@]}"; do
    #     if ps -p $PID > /dev/null; then
    #         kill $PID
    #         echo "Stopped worker with PID: $PID"
    #     fi
    # done
    exit 0
}

# Trap SIGTERM and SIGINT signals
trap cleanup SIGTERM SIGINT

# Change to the project directory
cd $PROJECT_DIR || exit

# Start queues
for ((i=1; i<=WORKERS; i++)); do
    echo "Starting worker $i on queue '$QUEUE_NAME'..."
    # Start a queue worker in the background and redirect output to the log file
    php artisan queue:work --queue="$QUEUE_NAME" >> $LOG_FILE 2>&1 &
    WORKER_PIDS+=($!)  # Store the PID of the worker
done

echo "Started $WORKERS queue workers on queue '$QUEUE_NAME'."

# Wait indefinitely, allowing the cleanup function to be called on exit
wait