kibbs.teamredminer
=========

Ansible role to setup teamredminer on Linux

Role Variables
--------------

`trm_bin_path` Path where binaries are installed (/usr/local/bin)
`trm_release_path` Path where source is installed (/opt)
`trm_version` Version of teamredminer to install (0.5.7)
`lrm_release_url` URL to download teamredminer from (see
defaults/main.yml)

Example Playbook
----------------

Including an example of how to use your role (for instance, with variables passed in as parameters) is always nice for users too:

    - hosts: servers
      vars:
        trm_bin_path: /usr/bin
        trm_version: '0.5.6'
      roles:
         - role: kibbs.teamredminer

License
-------

WTFPL
