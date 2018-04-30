#! /bin/bash

ansible-playbook -bK \
  -i hosts \
  safe-upgrade.yml $@
