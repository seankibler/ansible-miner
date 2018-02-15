#! /bin/bash

ansible-playbook --ask-sudo-pass \
  -i hosts \
  safe-upgrade.yml $@
