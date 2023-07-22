const MasterFetch = ( data ) => {
    const config = {
        headers : {
            'Content-Type' : 'application/json',
            'X-CSRF-TOKEN' : document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        method  : data.method,
    };

    if( JSON.stringify(data.data) !== '{}' ){
        config.body = JSON.stringify(data.data);
    }

    fetch(base_url + data.url, config)
    .then(response => response.json())
    .then(response => {
        if( !response.exito ){
            if( data.hasOwnProperty('errorFn') ){
                data.errorFn(response);
            }
        }

        if( data.hasOwnProperty('successFn') ){
            data.successFn(response);
        }
    })
    .catch(error => {
        if( data.hasOwnProperty('errorFn') ){
            data.errorFn(error);
        }
    })
    .finally(() => {
        // console.log('finally')
    })
}