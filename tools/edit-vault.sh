#! /bin/bash

ansible-vault edit \
  --vault-password-file ~/.ansible-miner-vault-password \
  group_vars/miners/vault.yml \
  $@
