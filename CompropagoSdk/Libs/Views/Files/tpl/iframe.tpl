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

{assign "id" ""}

{if $dataView }
    {if !empty($dataView->id)}
        {assign $id $dataView->id}
    {else}
        {assign $id $dataView}
    {/if}
{/if}

<div class="cpcontainer">
    <div class="cprow">
        <div class="cpcolumn" id="frameContainer">
            <iframe style="width: 100%;" id="cpFrame"
                    src="https://www.compropago.com/comprobante/?confirmation_id={$id}"
                    frameborder="0"
                    scrolling="yes">
            </iframe>
        </div>
    </div>
</div>

<script>

    function resize(){
        var container = document.querySelector("#frameContainer");
        var frame = document.querySelector("#cpFrame");

        if(frame && container){
            ratio = 585 / 811;
            width = container.offsetWidth;
            height = width / ratio;

            if(height > 937)
                height = 937;

            frame.style.width = width+"px";
            frame.style.height = height+"px";
        }
    }

    window.onload = resize;
    window.onresize = resize;

</script>
 