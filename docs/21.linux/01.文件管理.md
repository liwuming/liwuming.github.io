acme.sh  --issue --dns dns_dp -d ibiancheng.net  -d '*.ibiancheng.net'  



acme.sh到期自动更新



43 0 * * * "/root/.acme.sh"/acme.sh --cron --home "/root/.acme.sh" > /dev/null



acme.sh --installcert -d ibiancheng.net --key-file   /root/.acme.sh/ibiancheng.net/ibiancheng.net.key --fullchain-file /root/.acme.sh/ibiancheng.net/fullchain.cer --reloadcmd  "nginx -s reload"




[Sun May 21 10:28:09 CST 2023] Cert success.
-----BEGIN CERTIFICATE-----
MIIGfjCCBGagAwIBAgIRANgOMrin9ZIBk3pNtq8NzMwwDQYJKoZIhvcNAQEMBQAw
SzELMAkGA1UEBhMCQVQxEDAOBgNVBAoTB1plcm9TU0wxKjAoBgNVBAMTIVplcm9T
U0wgUlNBIERvbWFpbiBTZWN1cmUgU2l0ZSBDQTAeFw0yMzA1MjEwMDAwMDBaFw0y
MzA4MTkyMzU5NTlaMBkxFzAVBgNVBAMTDmliaWFuY2hlbmcubmV0MIIBIjANBgkq
hkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAwG38oDa6rjYoc6rZGDV5vm7eHx+gfiu1
0oytZsI4cJvtVACU4ZotlDo8ANGyPB2goqEUXQaEK7VIlTZNSmmwReY8z76xDddG
AXiA2u99Jg6iz9IRumwOLIU8CT0hhoUAbylTxa1obPc5wj2vQ17+dHPcX1fhriME
PV17S1dKjGf2foeuG95jTzLcKGcEBqMStn9JU4gUKfuY3vT9OqpTid90vNbyHMtj
YqNEHYMqcJXfiHzwkn8JFON1gGIEVS2BK1g+bEOOO/sEFg+UPJqLIyWiayR06CtP
PKtgBsMeM/di9nUI8P5jxH4FHLrHr1zu62urs8XycszYgeEpSRRP4wIDAQABo4IC
jTCCAokwHwYDVR0jBBgwFoAUyNl4aKLZGWjVPXLeXwo+3LWGhqYwHQYDVR0OBBYE
FHhBvRdwVTxz7LZm8AB9C7PdzZLsMA4GA1UdDwEB/wQEAwIFoDAMBgNVHRMBAf8E
AjAAMB0GA1UdJQQWMBQGCCsGAQUFBwMBBggrBgEFBQcDAjBJBgNVHSAEQjBAMDQG
CysGAQQBsjEBAgJOMCUwIwYIKwYBBQUHAgEWF2h0dHBzOi8vc2VjdGlnby5jb20v
Q1BTMAgGBmeBDAECATCBiAYIKwYBBQUHAQEEfDB6MEsGCCsGAQUFBzAChj9odHRw
Oi8vemVyb3NzbC5jcnQuc2VjdGlnby5jb20vWmVyb1NTTFJTQURvbWFpblNlY3Vy
ZVNpdGVDQS5jcnQwKwYIKwYBBQUHMAGGH2h0dHA6Ly96ZXJvc3NsLm9jc3Auc2Vj
dGlnby5jb20wggEFBgorBgEEAdZ5AgQCBIH2BIHzAPEAdwCt9776fP8QyIudPZwe
PhhqtGcpXc+xDCTKhYY069yCigAAAYg8InOYAAAEAwBIMEYCIQDhBcGNsTG+w5qH
Qm837Wr7poftb7vEPvvGBWfXg7yX1AIhAISIIbp5wD3C2L7oj21zuLBz/fuZHh27
5mtFVa/IS8x7AHYAejKMVNi3LbYg6jjgUh7phBZwMhOFTTvSK8E6V6NS61IAAAGI
PCJz8QAABAMARzBFAiEAosl8dBliJlHQxPGFMamk+J8lJHUaulapFuBFqsbW8QoC
IEfhhDPDLCgzzw8wbI6qMRQaTPZT/aEt8gEcw1vYBjEGMCsGA1UdEQQkMCKCDmli
aWFuY2hlbmcubmV0ghAqLmliaWFuY2hlbmcubmV0MA0GCSqGSIb3DQEBDAUAA4IC
AQApd7Su7p4Lj/xQRdRBytIAfujxwY+Y2ahnDX8Nfk4KKFsFdUMW6mh3WHTp333t
yRyKg9OeddojiEx0/joo0HxksDZOzp91Rff0y8PCWk6OuCXQvckCnDtBSik6q4jH
EZ/0pAc2moRuP/ON7F1LDKlURW6zE75Nvv8D40SRteuG5/m8LJde72fbDRdUNywo
/btH+HOLCAnL8yFjpukOzAsjos2bbz1TNoRQGL4gAcWnIu6OCf9WcnbqYEVeuoQi
mpmsQTfVU+ozXT/cuTK8t3uUMpTD2UhjWZsEc/iZ/CyEGHH9y/mrZ8IrL9Ogax9L
p5+8rY/egvQ5XpOCRy0H000dfQndUG4lKf33XevJTYN28CEhtgjfAvxqWU3FsFpp
/FuDucKhn3Tx8o03hKKzZWg6QvDMOhg6JV/XMpMEjM0wuUnZK2inaD1hi5seSq8S
r/jjllxf1pG+pWZnaJcSxj33njDkTNi5FZo3iEXt3fD6K5p9K48QCASjbDsayTwD
AKhHWaIya/+PRZAw4oh+gg2XbF5VHe44i2h5rGeKJaVDcSpGRrqtlIvOx9yP+qd/
H+B97izFIEjxFOhy2HsA74dJL1ksbvdj22c+nIXegmA9clIDqmm/ZNKpQbX+XBsH
ZEsz6WD9Xk2p0ZK8ef5FEP0v4Jlx/M7uhyNqfn+igXVUHw==
-----END CERTIFICATE-----
[Sun May 21 10:28:09 CST 2023] Your cert is in: /root/.acme.sh/ibiancheng.net/ibiancheng.net.cer
[Sun May 21 10:28:09 CST 2023] Your cert key is in: /root/.acme.sh/ibiancheng.net/ibiancheng.net.key
[Sun May 21 10:28:09 CST 2023] The intermediate CA cert is in: /root/.acme.sh/ibiancheng.net/ca.cer
[Sun May 21 10:28:09 CST 2023] And the full chain certs is there: /root/.acme.sh/ibiancheng.net/fullchain.cer


acme.sh --installcert -d ibiancheng.net \
--key-file       /path/to/keyfile/in/nginx/key.pem  \
--fullchain-file /path/to/fullchain/nginx/cert.pem \
--reloadcmd     "service nginx force-reload"