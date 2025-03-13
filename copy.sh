#!/bin/bash

# Function to handle cleanup
cleanup() {
    echo "Cleaning up..."
    # Add cleanup commands here
    exit 0
}

# Trap signals
trap cleanup SIGTERM SIGINT

# Simulate a long-running process
echo "Running... (Press Ctrl+C to stop)"
while true; do
    sleep 1
done