
<div class="container">
    <video autoplay='true' id="videoElement"></video>
    <canvas id="canvas-area"></canvas>
</div>
<div class="filter-btns">
    <button id="filter-standart" class="filter-button">Standart</button>
    <button id="filter-blur" class="filter-button">Blur</button>
    <button id="filter-bandw" class="filter-button">B&W</button>
    <button id="filter-inverse" class="filter-button">Inverse</button>
    <button id="filter-bluefill" class="filter-button">Bluefill</button>
    <button id="filter-noir" class="filter-button">Noir</button>
</div>

<div id="main-btns" class="container-btn">
    <button class='btn' id="shot-btn">Shot</button>
    <button class='btn' id="upload-img-btn">Upload Image</button>
</div>

<div id="publish-btns" class="container-btn">
    <button class='btn' id="publish-btn">Publish</button>
    <button class='btn' id="try-again-btn">Try Again</button>
</div>



<svg id='image' version="1.1" xmlns="http://www.w3.org/2000/svg">
    <defs>
        <filter id="blurEffect">
            <feGaussianBlur stdDeviation="3"/>
        </filter>

        <filter id="blackandwhite">
            <feColorMatrix values="0.3333 0.3333 0.3333 0 0
                                 0.3333 0.3333 0.3333 0 0
                                0.3333 0.3333 0.3333 0 0
                                0      0      0      1 0"/>
        </filter>

        <filter id="inverse">
            <feComponentTransfer>
            <feFuncR type="table" tableValues="1 0"/>
            <feFuncG type="table" tableValues="1 0"/>
            <feFuncB type="table" tableValues="1 0"/>
            </feComponentTransfer>
        </filter>

        <filter id="bluefill" x="0%" y="0%" width="100%" height="100%">
            <feFlood flood-color="blue" result="A"/>
            <feColorMatrix type="matrix" in="SourceGraphic" result="B" values="1   0  0  0 0  
                           0   1  0  0 0   
                           0   0  1  0 0   
                           1   1  1  0 0
                  "/>
            <feMerge>
            <feMergeNode in="A"/>
            <feMergeNode in="B"/>
            </feMerge>
        </filter>

        <filter id="noir">
            <feGaussianBlur stdDeviation="1.5"/>
            <feComponentTransfer>
            <feFuncR type="discrete" tableValues="0 .5 1 1"/>
            <feFuncG type="discrete" tableValues="0 .5 1"/>
            <feFuncB type="discrete" tableValues="0"/>
            </feComponentTransfer>
        </filter>
    </defs>
</svg>

<img src="">