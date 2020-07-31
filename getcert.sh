grep -A 27 -e '-----BEGIN PRIVATE KEY.*' /opt/psa/var/certificates/scfrW4AyS > ssl.key
grep -m 1 -A 31 -e '-----BEGIN CERTIFICATE-----.*' /opt/psa/var/certificates/scfrW4AyS > ssl.cert
cat /opt/psa/var/certificates/scfOAsWK7 > ssl.ca

