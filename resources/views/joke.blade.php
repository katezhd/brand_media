<div class="joke__wrap">
  <div class="joke">
    <div class="joke__overlay"></div>
    <span class="joke__text">{{ $data['text'] }}</span>
    <img class="joke__logo" src="{{ asset('/images/logo.svg') }}" alt="">
  </div>
</div>

<style>
  @font-face {
  font-family: "Mulish";
  src: url("/fonts/Mulish/Mulish-Regular.ttf") format("truetype");
  font-weight: 400;
  font-style: normal;
}

@font-face {
  font-family: "Mulish";
  src: url("/fonts/Mulish/Mulish-Bold.ttf") format("truetype");;
  font-weight: 700;
  font-style: normal;
}
  * {
    box-sizing: border-box;
  }
  body {
    margin: 0;
    padding: 0;
    font-family: 'Mulish', sans-serif;
  }
  .joke {
    width: 1200px;
    height: 630px;
    display: flex;
    padding: 50px;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    background-image: url('<?= asset('/images/logo.svg') ?>');
    background-size: 10%;
    background-repeat: no-repeat;
    background-position: 95% 90%;
  }
  .joke__overlay {
    background-color: #fff;
    display: block;
    border-radius: 10px;
    width: 200%;
    height: 200%;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    z-index: 1;
    opacity: 0.95;
  }
  .joke__logo {
    width: 10%;
    position: absolute;
    right: 5%;
    bottom: 10%;
    z-index: 2;
  }
  .joke__wrap {
    background-color: rgb(242, 246, 252);
    background-image: url('<?= asset('/images/smile.svg') ?>');
    background-size: 40%;
    background-repeat: no-repeat;
    background-position: 50% 50%;
    position: relative;
  }
  .joke__text {
    display: block;
    font-size: 40px;
    font-weight: 400;
    text-align: center;
    z-index: 2;
  }
</style>