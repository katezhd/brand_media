<div class="quote__wrap">
  <div class="quote">
    <div class="quote__overlay"></div>
    <img class="quote__svg" src="{{ asset('/images/quotes.svg') }}" alt="">
    <span class="quote__text">{{ $data['text'] }}</span>
    <span class="quote__author-wrap">
      <img class="quote__logo" src="{{ asset('/images/logo.svg') }}" alt="">
      @if(!empty($data['name']))
        <span class="quote__author">{{ $data['name'] }}</span>
      @endif
    </span>
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
  .quote__wrap {
    background-image: url('<?= asset('/images/quotes.svg') ?>');
    background-size: 50%;
    background-repeat: no-repeat;
    background-position: 50% 50%;
    position: relative;
    z-index: 5;
  }
  .quote__overlay {
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
  .quote {
    color: rgb(0, 47, 118);
    padding: 50px;
    width: 1200px;
    height: 630px;
    display: flex;
    flex-direction: column;
    align-items: inherit;
    justify-content: space-between;
    z-index: 5;
  }
  .quote__logo {
    width: 10%;
    position: absolute;
    left: 5%;
    bottom: 10%;
  }
  .quote__svg {
    width: 60px;
    height: 60px;
    margin-bottom: 20px;
    z-index: 2;
  }
  .quote__text {
    font-size: 40px;
    font-weight: 600;
    line-height: 1.2;
    display: block;
    margin: 0 auto;
    text-align: center;
    margin-bottom: 25px;
    z-index: 2;
  }
  .quote__author-wrap {
    width: 100%;
    margin-top: 20px;
    display: flex;
    justify-content: flex-end;
    align-items: center;
    z-index: 2;
  }
  .quote__author {
    position: relative;
    font-size: 30px;
    font-weight: 600;
    display: block;
  }
  .quote__author::before {
    content: '';
    position: absolute;
    left: -35px;
    top: 50%;
    display: block;
    width: 25px;
    height: 1px;
    background-color: rgb(0, 47, 118);
    z-index: 2;
  }
</style>