#!/bin/bash

# if [[ "$OSTYPE" == *"darwin"* ]]; then
#    echo "yes"
# fi

# if [[ "$OSTYPE" == "linux-gnu"* ]]; then
#         # ...
# elif [[ "$OSTYPE" == "darwin"* ]]; then
#         # Mac OSX
# elif [[ "$OSTYPE" == "cygwin" ]]; then
#         # POSIX compatibility layer and Linux environment emulation for Windows
# elif [[ "$OSTYPE" == "msys" ]]; then
#         # Lightweight shell and GNU utilities compiled for Windows (part of MinGW)
# elif [[ "$OSTYPE" == "win32" ]]; then
#         # I'm not sure this can happen.
# elif [[ "$OSTYPE" == "freebsd"* ]]; then
#         # ...
# else


FILE=~/.theme/localhost.crt

if [ -f "$FILE" ]; then
  exit;
else 
  echo "Making SSL certificate...";
  mkdir -p ~/.theme;
  openssl req -x509 -days 5000 -out ~/.theme/localhost.crt -keyout ~/.theme/localhost.key \
    -newkey rsa:2048 -nodes -sha256 \
    -subj '/CN=localhost' -extensions EXT -config <( \
   printf "[dn]\nCN=localhost\n[req]\ndistinguished_name = dn\n[EXT]\nsubjectAltName=DNS:localhost\nkeyUsage=digitalSignature\nextendedKeyUsage=serverAuth");
  if [ -d "/Library/Keychains" ]; then
    sudo security add-trusted-cert \
      -k /Library/Keychains/System.keychain \
      -d ~/.theme/localhost.crt;
  fi
fi
