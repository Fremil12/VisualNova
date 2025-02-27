<script module>
import { ref } from 'vue';



</script>

<template>

    <section class="gameArea">

        <img src="../images/DefaultRoomPicture.png">

        <div class="RoomTitle">
            <p>Room Title</p>
            <p>Description</p>
        </div>

        <div class="RoomText">
            <p>
                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the
                industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and
                scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap
                into electronic typesetting, remaining essentially unchanged.
            </p>
            <p>
                It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and
                more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
            </p>

            <p>
                It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).

            </p>
        </div>
        <div class="ButtonsWrapper">
            <div class="Buttons">
                <button>Do something</button>
                <button>Ignore for now</button>
            </div>
        </div>



    </section>

</template>

<style scoped>



.gameArea {
    margin: auto;

    max-width: 90%;
    width: 600px;
}

.gameArea img {
    width: 100%;
    height: auto;
    max-height: 300px;
    object-fit: cover;
}

.RoomTitle {
    text-align: center;
    background-color: #ddd;
    padding: 5px 0px;
}

.RoomTitle p:first-child {
    font-size: 120%;
    font-weight: 700;
}

.RoomTitle p {
    margin: 0px;
    color: #222;
}


.RoomText {
    text-align: justify;

    height: 300px;
    overflow-y: auto;
    padding: 10px 5% 10px 5%;
    background-color: #eee;
    box-shadow: 0px 50px 20px -50px rgba(0, 0, 0, 0.3);
}

.RoomText p {
    font-size: 90%;
    margin: 0px 0px 20px 0px;
}

.ButtonsWrapper {
    width: 80%;
    margin: auto;
    overflow: hidden;
}

.Buttons {
}



.Buttons button {
    display: block;
    margin: 5px auto;
    border: none;
    border-top: 2px solid black;
    border-bottom: 2px solid black;
    background: transparent;
    padding: 10px 20px;
    cursor: pointer;
    min-width: max-content;
    width: 80%;
    box-shadow: 0 0px 10px 0px rgba(0, 0, 0, 0.3);
    transition: scale, width 0.3s ease-in-out, color 0.3s ease-in-out; 
}

.Buttons button:hover{
    scale:110%;
    width: 100%;
    
}

.Buttons button:active{
    scale:90%;
    width: 100%;
}
</style>
