<?php
$config = array ( 
        //应用ID,您的APPID。
        'app_id' => "2016101600702323",

        //商户私钥
        'merchant_private_key' => "MIIEoQIBAAKCAQEArz+vuS3PR7VUoTJFGw5bZpVjMQ9/nM9erRGMjzJiYsJNmBxXXuKyJyBhPdCm4y/PbhTunAgSq2WutAhVoRBHb1mL8mLUzeA8uH4qU4m76SsgfTS4bXizXIL6t8Zggvq3Phx8Twl5e6KyTTeKPhlP0SK9OBRitILbioGqdIb0hWU+GgTe5b04g99EHkeRiTlmMT486SC8iB8LpRgcIQRxka/I+5HjhVYiLQzhafhQ7Leqoxs46fVsi7Ixyli+3l3QJsROh4FA7GzkiYVNE+0+yj+tbBYrTJMd/ZB+RuQzzGsREiV2H2QPvPE0U8FuxZSG5orMfDIhTgcLmzFCTN/azQIDAQABAoIBAQCMrcIhE93+AVkjYVhKJNdIXQlYO8nEFk84/QppdRe3kaR6Q937JF3AvORym8ksPJf2FUWJ6Y0bG7AHg11BwvClOSv3clDDx4rWyyitELbQsTcOa0DVV/wbemVLGyskWaC5cmJzi/aCQhOBmuEVgnopNwrQNsUZhKY55GbxzdgCL/Qe56uqpd+ef3pXq/+5AvJiZhHRFBgy3CarfvJCkUqNYRCnfzj6yDuowyVgA90Sf+W+BQWjcfI/MRP/0YtXY6mF53Pq/Zjik18kTZGqNbDsYBJ044FnylMVV2MKyubEEcy1mM47zAYW8mKfxYz/NTpX+4WjOY0H6HLL6CMQ1O7hAoGBAN4Fa1Du1BazfSHdMfjVJiEMv1oH0YXSajLDz2MRMR9KR+rID/f8NDHxsk0r12uIdHyKtpuE19VmmWgN6FvD1WSP3oucjvpq9tr6Wo1gCtXAYWu+voQjDKEGNs/pIsVQ3wEiIVc8i1RFbn0I5KQD9R/D5AovIe698K2lwSJqkEdZAoGBAMoRxM5xh1FLpA9yMjUJQfuL0efQSI44w1h1+CCIJESnzgbFm4XpixeoK5OtbKucJks1oS9HK/TjsK6ZMjebI4H9esgFJxK0kr5nc44ue9eevIaRBt1g846n8/QlIlKILT4k3ToR7LzBqaCXY/zW23AfOy+tZDRTtiQ+xm364nSVAoGADK4kje/F/zHrIKcAdqS9079lol+18L2uwQ17572Qn6ffaaJZfyFRXdTfCRdK62JUvNQzT7iLly2P72hz7+HEa0ToQfMEG3tGdAU+bLqig8jEB6JSQTu7Oesf8EnxaXGP+wGXA+N6VarNf6ilXlS3iEPo30gH2RnSCCjiWfPaH6kCf0fUCSFZOcCsIqVa8n3nzIyeJv9ACoqDouzPAmSOAFZnT9UYaTAw1ECUhuj3vKlD2Fjjt2gW5IkoZqWpzy/09ao/cGWpbzo29fK401q3K056Hom3A7mtvOX4zb77dDfiMDLm57y8omp2bNWo+uHlfhtc/qzz9aqkFxrLNb3icJ0CgYBuZcYo7EdA8zG7jncLirhjoh6lRhoZWqba+QfSKhajnmQgI4TYIqh0J+UzN7+1wHeSj/jgKw3S680E99UGAArjqiYtjsKPz53BU4zWTIxpJhE0utVhhaKHSnZ94ENQedrYhjAAJMOBLWhabQ+UXXYxU401yZKXvgt17b5w3DUPvw==",
        
        //异步通知地址
        'notify_url' => "http://www.laoguatou.com/home/asynch",
        
        //同步跳转
        'return_url' => "http://www.laoguatou.com/home/synch",

        //编码格式
        'charset' => "UTF-8",

        //签名方式
        'sign_type'=>"RSA2",

        //支付宝网关
        // 'gatewayUrl' => "https://openapi.alipay.com/gateway.do",
        'gatewayUrl' => "https://openapi.alipaydev.com/gateway.do",

        //支付宝公钥,查看地址：https://openhome.alipay.com/platform/keyManage.htm 对应APPID下的支付宝公钥。
        'alipay_public_key' => "MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAqH7ZKUvVaWR+KbNDHn3uXKL1Tz9T+ePJQn+rAWeHN3Z57R3Byzvvf6TquOwNBJUqah2Pn0sI0Ss7tvgQWU/Sgd/7tv52+vuKuBdFeDnosIs6U9fwmlbWhF4zOyx2BlBSFmtgZgQl2uxlEDJhKKJkgRJfAm9pzry+ceZO32m6xijUOTrVKzaRKol/OuHoKJzeEAKCqX9VKcsRVQFql5pMiCMug6qdons2H+etAaOrSNavGe3ZX4v+eeX07hkqrv0DHhKhhlKetsc8ZU+aF0pvYSugkF/ruCTZ3cjsGHT9ill18a744Zmt2Lx9kFNhnBEtHktxrhBx3L32TJp+jCKgzQIDAQAB",
    );