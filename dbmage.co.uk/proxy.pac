function FindProxyForURL(url, host) {
    var proxy = "PROXY 192.168.0.2:3128; DIRECT";
    var direct = "DIRECT";
        
    // no proxy for local hosts without domain:
    if(isPlainHostName(host)) return direct;

    // proxy everything else:
    return proxy;
}
