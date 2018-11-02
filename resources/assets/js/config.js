var api_url = '';
var google_maps_js_api = 'AIzaSyCe72MTN9BWkZKdVbM7P2f5NOo7_XGeyys';

switch( process.env.NODE_ENV ){
    case 'development':
        api_url = '/api/v1';
        break;
    case 'production':
        api_url = '/api/v1';
        break;
}

export const YARD_CONFIG = {
    API_URL: api_url,
    GOOGLE_MAPS_JS_API: google_maps_js_api
}