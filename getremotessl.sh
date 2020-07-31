ssh -tt root@213.229.94.185 << 'EOT'
cd /var/www/vhosts/muon.pt/epartner.muon.pt
sh getcert.sh
exit
EOT
sftp root@213.229.94.185 << %EOF%
cd /var/www/vhosts/muon.pt/epartner.muon.pt
mget ssl.*
exit
%EOF%
