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

<div id="cpWrapper" class="cpcontainer">
    <div class="cprow">
        <div class="cpcolumn">
            <h3>{$dataView['description']}</h3>
        </div>
    </div>

    <div class="cprow">
        <div class="cpcolumn">
            {$dataView['instructions']}<br>
            <hr>
        </div>
    </div>

    <div class="cprow">
        <div class="cpcolumn">
            {if $dataView['showLogo'] == 'yes'}
                <ul>
                    {foreach from=$dataView['providers'] item=$provider}
                        <li>
                            <input type="radio" id="compropago_{$provider->internal_name}"
                                   name="compropagoProvider"
                                   value="{$provider->internal_name}"
                                   image-label="{$provider->internal_name}">

                            <label for="compropago_{$provider->internal_name}">
                                <img src="{$provider->image_medium}" alt="{$provider->name}">
                            </label>
                        </li>
                    {/foreach}
                </ul>
            {else}
                <select name="compropagoProvider">
                    {foreach from=$dataView['providers'] item=$provider}
                        <option value="{$provider->intenar_name}">{$provider->name}</option>
                    {/foreach}
                </select>
            {/if}
        </div>
    </div>
</div>
 