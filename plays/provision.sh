#! /bin/bash

DIR="$( cd "$( dirname "${BASH_SOURCE[0]}" )" && pwd )"

ansible-playbook --ask-sudo-pass \
  -i $DIR/../hosts \
  --vault-password-file $HOME/.ansible-miner-vault-password \
  $DIR/provision.yml $@
