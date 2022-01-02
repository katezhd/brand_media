<div class="horoscope">
  <div class="horoscope__bg">
      <div class="horoscope__overlay"></div>
      <span class="horoscope__name">{{ $data['sign_name'] }}</span>
      <span class="horoscope__text">{{ $data['text'] }}</span>
  </div>
  <div class="horoscope__aside">
      <img class="horoscope__img" src="{{ asset('/images/horoscope').'/'.$data['slug'] . '.svg'}}">
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
  .horoscope {
    background-image: url('<?= asset('/images/horoscope').'/'.$data['slug'] . '.svg' ?>');
    width: 1200px;
    height: 630px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 20px;
    position: relative;
    padding: 50px;
    border: 3px solid rgb(0, 47, 118);
    border-radius: 10px;
    background-size: 50%;
    background-repeat: no-repeat;
    background-position: 30% 50%;
  }
  .horoscope__overlay {
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
  .horoscope__bg {
    z-index: 1;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    gap: 50px;
    width: 75%;
  }
  .horoscope__name {
    font-size: 80px;
    font-weight: 700;
    line-height: 1;
    text-align: center;
    color: rgb(0, 47, 118);
    z-index: 2;
  }
  .horoscope__text {
    z-index: 3;
    font-size: 35px;
    text-align: center;
    display: block;
  }
  .horoscope__aside {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: space-between;
    z-index: 3;
    gap: 40px;
    width: 25%;
    height: 100%;
    background-image: url('<?= asset('/images/logo.svg') ?>');
    background-size: 45%;
    background-repeat: no-repeat;
    background-position: 90% 97%;
  }
  .horoscope__img {
    width: 150px;
    height: 150px;
  }
</style>