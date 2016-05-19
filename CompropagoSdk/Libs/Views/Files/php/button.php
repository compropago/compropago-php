<?php
/**
 * Copyright 2015 Compropago.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */
/**
 * Compropago views-sdk
 * @author Eduardo Aguilar <eduardo.aguilar@compropago.com>
 */

$publickey       = isset($dataView['publickey']) ? $dataView['publickey'] : "" ;
$client_name     = isset($dataView['client_name']) ? $dataView['client_name'] : "SDK; viewssdk 1.0.0" ;
$version         = isset($dataView['version']) ? $dataView['version'] : '1.1' ;
$customer_name   = isset($dataView['customer_name']) ? $dataView['customer_name'] : "" ;
$customer_email  = isset($dataView['customer_email']) ? $dataView['customer_email'] : "" ;
$order_price     = isset($dataView['order_price']) ? $dataView['order_price'] : "" ;
$order_id        = isset($dataView['order_id']) ? $dataView['order_id'] : "" ;
$order_name      = isset($dataView['order_name']) ? $dataView['order_name'] : "" ;
$success_url     = isset($dataView['success_url']) ? $dataView['success_url'] : "" ;
$failure_url     = isset($dataView['failure_url']) ? $dataView['failure_url'] : "" ;

?>

<form action="https://www.compropago.com/comprobante/" method="post">
    <input type="hidden" name="public_key"              value="<?php echo $publickey; ?>" />
    <input type="hidden" name="app_client_name"         value="<?php echo $client_name; ?>" />
    <input type="hidden" name="app_client_version"      value="<?php echo $version; ?>" />
    <input type="hidden" name="customer_name"           value="<?php echo $customer_name; ?>" />
    <input type="hidden" name="customer_email"          value="<?php echo $customer_email; ?>" />
    <input type="hidden" name="product_price"           value="<?php echo $order_price; ?>" />
    <input type="hidden" name="product_id"              value="<?php echo $order_id; ?>" />
    <input type="hidden" name="product_name"            value="<?php echo $order_name; ?>" />
    <input type="hidden" name="success_url"             value="<?php echo $success_url; ?>" />
    <input type="hidden" name="failed_url"              value="<?php echo $failure_url; ?>" />
    <input type="hidden" name="customer_data_blocked"   value="false" />
    <input type="submit" alt="Compropago" class="cpbutton cpbutton-primary" value="Pagar en Efectivo" />
</form>
