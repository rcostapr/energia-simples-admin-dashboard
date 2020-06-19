grep -A 27 -e '-----BEGIN PRIVATE KEY.*' /opt/psa/var/certificates/scfSVHTDo > ssl.key
grep -m 1 -A 32 -e '-----BEGIN CERTIFICATE-----.*' /opt/psa/var/certificates/scfSVHTDo > ssl.cert
cat /opt/psa/var/certificates/scfcobv1V > ssl.ca
