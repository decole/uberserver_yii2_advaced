#!/bin/bash

set -ex

cat ~/.docker_password.txt | docker login --username 13123123 --password-stdin

docker build -t uberserver:latest .
docker tag uberserver:latest 13123123/uberserver:latest
docker push 13123123/uberserver:latest
