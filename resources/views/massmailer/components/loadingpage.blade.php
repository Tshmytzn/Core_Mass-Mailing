<style>
    /* Full-screen overlay with transparent black background */
    .overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5); /* Transparent black */
        display: none;
        justify-content: center;
        align-items: center;
        z-index: 1000; /* High z-index to overlay all content */
    }

    /* Spinner styles */
    .spinner {
        background-image: linear-gradient(rgb(186, 66, 255) 35%, rgb(0, 225, 255));
        width: 100px;
        height: 100px;
        animation: spinning82341 1.7s linear infinite;
        text-align: center;
        border-radius: 50px;
        filter: blur(1px);
        box-shadow: 0px -5px 20px 0px rgb(186, 66, 255), 0px 5px 20px 0px rgb(0, 225, 255);
    }

    .spinner1 {
        background-color: rgb(36, 36, 36);
        width: 100px;
        height: 100px;
        border-radius: 50px;
        filter: blur(10px);
    }

    /* Spinner animation */
    @keyframes spinning82341 {
        to {
            transform: rotate(360deg);
        }
    }
</style>

<!-- Overlay with centered spinner -->
<div class="overlay" id="loadingPage">
    <div class="spinner">
        <div class="spinner1"></div>
    </div>
</div>
