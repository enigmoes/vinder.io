<?php
namespace App\Routing\Filter;

use Cake\Event\Event;
use Cake\Routing\DispatcherFilter;

/**
 * Api Cors Dispatcher
 */
class ApiCorsFilter extends DispatcherFilter {

    public function beforeDispatch(Event $event)
    {
        $request = $event->getData('request');
        $response = $event->getData('response');
        $origin = filter_has_var(INPUT_SERVER,'HTTP_ORIGIN') ? filter_input(INPUT_SERVER,'HTTP_ORIGIN') : '*';
        $response->header('Access-Control-Allow-Origin', $origin);
        $response->header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
        if (filter_has_var(INPUT_SERVER, 'HTTP_ACCESS_CONTROL_REQUEST_HEADERS')) {
            $response->header('Access-Control-Allow-Headers', filter_input(INPUT_SERVER, 'HTTP_ACCESS_CONTROL_REQUEST_HEADERS'));
        }
        if ($request->is('OPTIONS')) {
            $event->stopPropagation();
            return $response;
        }
    }

}
