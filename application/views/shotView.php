
<div class="container">
    
    <video autoplay='true' id="videoElement"></video>
    <canvas id="canvas-area"></canvas>
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
    </defs>
</svg>

<img src="">