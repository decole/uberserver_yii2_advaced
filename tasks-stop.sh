#!/usr/bin/env bash

output=`pgrep -f 'task/run'`
if [[ -n "${output}" ]]; then
    pgrep -f 'task/run' | xargs kill
fi

output=`pgrep -f 'task-queue'`
if [[ -n "${output}" ]]; then
    pgrep -f 'task-queue' | xargs kill
fi
