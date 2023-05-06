<style>
.footer{
  position: relative;
  width: 100%;
  background: #ba2916;
  display: flex;
  justify-content: space-between;
  flex-wrap: wrap;
  padding-bottom: 150px;
  display: flex;
  flex-flow: row wrap;
  padding: 30px 0px 20px 0;
  color: #ffffff;
  box-shadow: 0px 2px 2px rgb(0 0 0 / 50%);
  height: 250px;
  height: auto;
  font-family: -apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif;
  font-size: 16px;
}

.footer > * {
  flex:  1 100%;
}

.footer__addr {
  margin-right: 1.25em;
  margin-bottom: 2em;
}

.footer__logo {
  /*font-family: 'Montserrat';*/
  font-weight: 400;
  font-size: 1.5rem;
  margin-left: 10px;
}

.footer__addr h2 {
  margin-top: 1.3em;
  font-size: 15px;
  font-weight: 400;
}

.nav__title {
  font-weight: 400;
  font-size: 20px;
}

.footer address {
  font-style: normal;
  color: #ffffff;
}

.footer__btn {
  display: flex;
  align-items: center;
  justify-content: center;
  height: 36px;
  max-width: max-content;
  background-color: rgb(33, 33, 33, 0.07);
  border-radius: 100px;
  color: #2f2f2f;
  line-height: 0;
  margin: 0.6em 0;
  font-size: 1rem;
  padding: 0 1.3em;
}

.footer ul {
  list-style: none;
  padding-left: 0;
}

.footer li {
  line-height: 2em;
}

.footer a {
  text-decoration: none;
}

.footer__nav {
  display: flex;
flex-flow: row wrap;
}

.footer__nav > * {
  flex: 1 50%;
  margin-right: 1.25em;
}

.nav__ul a {
  color: #ffffff;
  line-height: 30px;
}

.nav__ul--extra {
  column-count: 2;
  column-gap: 1.25em;
}

.legal {
  display: inline-block;
  flex-wrap: wrap;
  color: #ffffff;
  text-align: center;
}
  
.legal__links {
  display: flex;
  align-items: center;
}


@media screen and (min-width: 24.375em) {
  .legal .legal__links {
    margin-left: auto;
  }
}

@media screen and (min-width: 40.375em) {
  .footer__nav > * {
    flex: 1;
  }
  
  .nav__item--extra {
    flex-grow: 2;
  }
  
  .footer__addr {
    flex: 1 0px;
  }
  
  .footer__nav {
    flex: 2 0px;
  }
}

</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<footer class="footer">
  <div class="footer__addr">
    <h1 class="footer__logo">Blood Bank</h1>
    <h2 style="margin-left: 10px;">Address:</h2>
    <address style="margin-top: 20px; margin-left:10px;">
          280 An Duong Vuong, Phuong 4, Quan 5, TP.HCM
    </address>
    <h2 style="margin-left: 10px;">Open: 7AM - 18PM (every day of week)</h2>
  </div>
     <ul class="footer__nav">
          <li class="nav__item">
               <h2 class="nav__title">Teammate ♥</h2>
               <ul class="nav__ul">
                    <li>
                         <a>Vũ Trường Sơn</a>
                    </li>
                    <li>
                         <a>Đỗ Quang Nghĩa</a>
                    </li>
                    <li>
                         <a>Nguyễn Hồng Nguyên</a>
                    </li>
               </ul>
          </li>
          <li class="nav__item">
               <h2 class="nav__title">MSSV ♥</h2>
               <ul class="nav__ul">
                    <li>
                         <a>45.01.104.200</a>
                    </li>
                    <li>
                         <a>45.01.104.156</a>
                    </li>
                    <li>
                         <a>45.01.104.163</a>
                    </li>
                  
               </ul>
          </li>
          <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3919.650441027888!2d106.6799987142869!3d10.761400462414782!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31752f1b888ab357%3A0xc469f6e800231314!2zMjgwIEFuIEQuIFbGsMahbmcsIFBoxrDhu51uZyA0LCBRdeG6rW4gNSwgVGjDoG5oIHBo4buRIEjhu5MgQ2jDrSBNaW5oLCBWaeG7h3QgTmFt!5e0!3m2!1svi!2s!4v1652426258805!5m2!1svi!2s" width="100" height="220" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
     </ul>
  <div class="legal">
    <p>&copy; 2023 Something. All rights reserved.</p>
  </div>
</footer>

