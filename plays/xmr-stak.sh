#! /bin/bash

DIR="$( cd "$( dirname "${BASH_SOURCE[0]}" )" && pwd )"

ansible-playbook -bK \
  -i $DIR/../hosts \
  --vault-password-file $HOME/.ansible-miner-vault-password \
  $DIR/../xmr-stak.yml $@
