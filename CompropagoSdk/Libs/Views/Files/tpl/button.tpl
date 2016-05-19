{**
 * Copyright 2016 Compropago. 
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
 *
 * ComproPago views-sdk
 * @author Eduardo Aguilar <eduardo.aguilar@compropago.com>
 *}

{if isset($dataView['publickey'])} {$publickey=$dataView['publickey']} {else} {$publickey=''} {/if}
{if isset($dataView['client_name'])} {$client_name=$dataView['client_name']} {else} {$client_name=''} {/if}
{if isset($dataView['version'])} {$version=$dataView['version']} {else} {$version=''} {/if}
{if isset($dataView['customer_name'])} {$customer_name=$dataView['customer_name']} {else} {$customer_name=''} {/if}
{if isset($dataView['customer_email'])} {$customer_email=$dataView['customer_email']} {else} {$customer_email=''} {/if}
{if isset($dataView['order_price'])} {$order_price=$dataView['order_price']} {else} {$order_price=''} {/if}
{if isset($dataView['order_id'])} {$order_id=$dataView['order_id']} {else} {$order_id=''} {/if}
{if isset($dataView['order_name'])} {$order_name=$dataView['order_name']} {else} {$order_name=''} {/if}
{if isset($dataView['success_url'])} {$success_url=$dataView['success_url']} {else} {$success_url=''} {/if}
{if isset($dataView['failure_url'])} {$failure_url=$dataView['failure_url']} {else} {$failure_url=''} {/if}


<form action="https://www.compropago.com/comprobante/" method="post">
    <input type="hidden" name="public_key"              value="{$publickey}" />
    <input type="hidden" name="app_client_name"         value="{$client_name}" />
    <input type="hidden" name="app_client_version"      value="{$version}" />
    <input type="hidden" name="customer_name"           value="{$customer_name}" />
    <input type="hidden" name="customer_email"          value="{$customer_email}" />
    <input type="hidden" name="product_price"           value="{$order_price}" />
    <input type="hidden" name="product_id"              value="{$order_id}" />
    <input type="hidden" name="product_name"            value="{$order_name}" />
    <input type="hidden" name="success_url"             value="{$success_url}" />
    <input type="hidden" name="failed_url"              value="{$failure_url}" />
    <input type="hidden" name="customer_data_blocked"   value="false" />
    <input type="submit" alt="Compropago" class="cpbutton cpbutton-primary" value="Pagar en Efectivo" />
</form>