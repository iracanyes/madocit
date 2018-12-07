/**
 * Author: iracanyes
 * Date: 11/19/18
 * Description:
 */
import React, {Component, Fragment} from 'react';
import '../assets/css/main.css';
import CarouselCategories from '../components/category/CarouselCategories';
import IconCss from '../assets/img/icone/css-3-icon.png';
import IconHtml from "../assets/img/icone/html-5-icon.png";
import IconSass from "../assets/img/icone/sass.png";
import IconJs from "../assets/img/icone/javascript.png";
import IconPhp from "../assets/img/icone/php-icon.png";
import IconJquery from "../assets/img/icone/jquery.png";


export default class Homepage extends Component
{
    render(){
        return <Fragment>
            <section id="main-content" className="col-lg-7 float-left">
                {/* Carousel - Categories  */}
                <section className="category-cards bg-white pt60 pb60">
                    <div className="container-fluid">
                        <h3>Catégories</h3>
                        <CarouselCategories/>
                    </div>
                    {/* .container */}
                </section>

                {/* Parallax image 1 */}
                <div className="parallax parallax-main parallax1 parallax-plus-box">

                    <div className="card">
                        <h5 className="card-header">Featured</h5>
                        <div className="card-body">
                            <h5 className="card-title">Special title treatment</h5>
                            <p className="card-text">With supporting text below as a natural lead-in to additional
                                content.</p>
                            <a href="#" className="btn btn-primary">Go somewhere</a>
                        </div>
                    </div>
                </div>

                {/* Thèmes récents  */}

                <section className="section-owl-carousel bg-white pt60 pb60">
                    <div className="container-fluid">
                        <h3>Thèmes récents</h3>
                        <div id="owl-home-2" className="owl-carousel owl-theme">
                            <article className="thumbnail item" itemScope="" itemType="http://schema.org/CreativeWork">
                                <a className="blog-thumb-img" href="/5-ways-baby-boomers-changing-healthcare/" title="">
                                    <img src="http://placehold.it/500x250" className="img-responsive"/>
                                </a>
                                <div className="caption">
                                    <h4 itemProp="headline">
                                        <a href="#" rel="bookmark">5 Ways Baby Boomers Are Changing Healthcare</a>
                                    </h4>
                                    <p itemProp="text" className="flex-text text-muted">5 ways baby boomers are changing
                                        healthcare Starting in 2011, 3 million baby boomers each year reach retirement
                                        age....</p>
                                </div>
                            </article>

                            <article className="thumbnail item" itemScope="" itemType="http://schema.org/CreativeWork">
                                <a className="blog-thumb-img" href="/5-ways-baby-boomers-changing-healthcare/" title="">
                                    <img src="http://placehold.it/500x250" className="img-responsive"/>
                                </a>
                                <div className="caption">
                                    <h4 itemProp="headline">
                                        <a href="#" rel="bookmark">5 Ways Baby Boomers Are Changing Healthcare</a>
                                    </h4>
                                    <p itemProp="text" className="flex-text text-muted">5 ways baby boomers are changing
                                        healthcare Starting in 2011, 3 million baby boomers each year reach retirement age
                                        asdf asdfas dfasd fasdf asdf asfasdf asdf....</p>
                                </div>
                            </article>

                            <article className="thumbnail item" itemScope="" itemType="http://schema.org/CreativeWork">
                                <a className="blog-thumb-img" href="/5-ways-baby-boomers-changing-healthcare/" title="">
                                    <img src="http://placehold.it/500x250" className="img-responsive"/>
                                </a>
                                <div className="caption">
                                    <h4 itemProp="headline">
                                        <a href="#" rel="bookmark">5 Ways Baby Boomers Are Changing Healthcare</a>
                                    </h4>
                                    <p itemProp="text" className="flex-text text-muted">5 ways baby boomers are changing
                                        healthcare Starting in 2011, 3 million baby boomers each year reach retirement
                                        age....</p>
                                </div>
                            </article>

                            <article className="thumbnail item" itemScope="" itemType="http://schema.org/CreativeWork">
                                <a className="blog-thumb-img" href="/5-ways-baby-boomers-changing-healthcare/" title="">
                                    <img src="http://placehold.it/500x250" className="img-responsive"/>
                                </a>
                                <div className="caption">
                                    <h4 itemProp="headline">
                                        <a href="#" rel="bookmark">5 Ways Baby Boomers Are Changing Healthcare</a>
                                    </h4>
                                    <p itemProp="text" className="flex-text text-muted">5 ways baby boomers are changing
                                        healthcare Starting in 2011, 3 million baby boomers each year reach retirement
                                        age....</p>
                                </div>
                            </article>

                            <article className="thumbnail item" itemScope="" itemType="http://schema.org/CreativeWork">
                                <a className="blog-thumb-img" href="/5-ways-baby-boomers-changing-healthcare/" title="">
                                    <img src="http://placehold.it/500x250" className="img-responsive"/>
                                </a>
                                <div className="caption">
                                    <h4 itemProp="headline">
                                        <a href="#" rel="bookmark">5 Ways Baby Boomers Are Changing Healthcare</a>
                                    </h4>
                                    <p itemProp="text" className="flex-text text-muted">5 ways baby boomers are changing
                                        healthcare Starting in 2011, 3 million baby boomers each year reach retirement
                                        age....</p>
                                </div>
                            </article>

                            <article className="thumbnail item" itemScope="" itemType="http://schema.org/CreativeWork">
                                <a className="blog-thumb-img" href="/5-ways-baby-boomers-changing-healthcare/" title="">
                                    <img src="http://placehold.it/500x250" className="img-responsive"/>
                                </a>
                                <div className="caption">
                                    <h4 itemProp="headline">
                                        <a href="#" rel="bookmark">5 Ways Baby Boomers Are Changing Healthcare</a>
                                    </h4>
                                    <p itemProp="text" className="flex-text text-muted">5 ways baby boomers are changing
                                        healthcare Starting in 2011, 3 million baby boomers each year reach retirement
                                        age....</p>
                                </div>
                            </article>

                            <article className="thumbnail item" itemScope="" itemType="http://schema.org/CreativeWork">
                                <a className="blog-thumb-img" href="/5-ways-baby-boomers-changing-healthcare/" title="">
                                    <img src="http://placehold.it/500x250" className="img-responsive"/>
                                </a>
                                <div className="caption">
                                    <h4 itemProp="headline">
                                        <a href="#" rel="bookmark">5 Ways Baby Boomers Are Changing Healthcare</a>
                                    </h4>
                                    <p itemProp="text" className="flex-text text-muted">5 ways baby boomers are changing
                                        healthcare Starting in 2011, 3 million baby boomers each year reach retirement
                                        age....</p>
                                </div>
                            </article>

                            <article className="thumbnail item" itemScope="" itemType="http://schema.org/CreativeWork">
                                <a className="blog-thumb-img" href="/5-ways-baby-boomers-changing-healthcare/" title="">
                                    <img src="http://placehold.it/500x250" className="img-responsive"/>
                                </a>
                                <div className="caption">
                                    <h4 itemProp="headline">
                                        <a href="#" rel="bookmark">5 Ways Baby Boomers Are Changing Healthcare</a>
                                    </h4>
                                    <p itemProp="text" className="flex-text text-muted">5 ways baby boomers are changing
                                        healthcare Starting in 2011, 3 million baby boomers each year reach retirement
                                        age....</p>
                                </div>
                            </article>

                            <article className="thumbnail item" itemScope="" itemType="http://schema.org/CreativeWork">
                                <a className="blog-thumb-img" href="/5-ways-baby-boomers-changing-healthcare/" title="">
                                    <img src="http://placehold.it/500x250" className="img-responsive"/>
                                </a>
                                <div className="caption">
                                    <h4 itemProp="headline">
                                        <a href="#" rel="bookmark">5 Ways Baby Boomers Are Changing Healthcare</a>
                                    </h4>
                                    <p itemProp="text" className="flex-text text-muted">5 ways baby boomers are changing
                                        healthcare Starting in 2011, 3 million baby boomers each year reach retirement
                                        age....</p>
                                </div>
                            </article>

                            <article className="thumbnail item" itemScope="" itemType="http://schema.org/CreativeWork">
                                <a className="blog-thumb-img" href="/5-ways-baby-boomers-changing-healthcare/" title="">
                                    <img src="http://placehold.it/500x250" className="img-responsive"/>
                                </a>
                                <div className="caption">
                                    <h4 itemProp="headline">
                                        <a href="#" rel="bookmark">5 Ways Baby Boomers Are Changing Healthcare</a>
                                    </h4>
                                    <p itemProp="text" className="flex-text text-muted">5 ways baby boomers are changing
                                        healthcare Starting in 2011, 3 million baby boomers each year reach retirement
                                        age....</p>
                                </div>
                            </article>
                        </div>
                        {/* #owl-carousel-1*/}

                    </div>
                    {/* .container */}

                </section>

                {/* Parallax image 2 */}
                <div className="parallax parallax-main parallax2 parallax-plus-box">

                    <div className="card">
                        <h5 className="card-header">Featured</h5>
                        <div className="card-body">
                            <h5 className="card-title">Special title treatment</h5>
                            <p className="card-text">With supporting text below as a natural lead-in to additional
                                content.</p>
                            <a href="#" className="btn btn-primary">Go somewhere</a>
                        </div>
                    </div>
                </div>

                {/* Notes récentes  */}
                <section className="section-owl-carousel bg-white pt60 pb60">

                    <div className="container-fluid">
                        <h3>Articles récents</h3>
                        <div id="owl-home-3" className="owl-carousel owl-theme">
                            <article className="thumbnail item" itemScope="" itemType="http://schema.org/CreativeWork">
                                <a className="blog-thumb-img" href="/5-ways-baby-boomers-changing-healthcare/" title="">
                                    <img src="http://placehold.it/500x250" className="img-responsive"/>
                                </a>
                                <div className="caption">
                                    <h4 itemProp="headline">
                                        <a href="#" rel="bookmark">5 Ways Baby Boomers Are Changing Healthcare</a>
                                    </h4>
                                    <p itemProp="text" className="flex-text text-muted">5 ways baby boomers are changing
                                        healthcare Starting in 2011, 3 million baby boomers each year reach retirement
                                        age....</p>
                                </div>
                            </article>

                            <article className="thumbnail item" itemScope="" itemType="http://schema.org/CreativeWork">
                                <a className="blog-thumb-img" href="/5-ways-baby-boomers-changing-healthcare/" title="">
                                    <img src="http://placehold.it/500x250" className="img-responsive"/>
                                </a>
                                <div className="caption">
                                    <h4 itemProp="headline">
                                        <a href="#" rel="bookmark">5 Ways Baby Boomers Are Changing Healthcare</a>
                                    </h4>
                                    <p itemProp="text" className="flex-text text-muted">5 ways baby boomers are changing
                                        healthcare Starting in 2011, 3 million baby boomers each year reach retirement age
                                        asdf asdfas dfasd fasdf asdf asfasdf asdf....</p>
                                </div>
                            </article>

                            <article className="thumbnail item" itemScope="" itemType="http://schema.org/CreativeWork">
                                <a className="blog-thumb-img" href="/5-ways-baby-boomers-changing-healthcare/" title="">
                                    <img src="http://placehold.it/500x250" className="img-responsive"/>
                                </a>
                                <div className="caption">
                                    <h4 itemProp="headline">
                                        <a href="#" rel="bookmark">5 Ways Baby Boomers Are Changing Healthcare</a>
                                    </h4>
                                    <p itemProp="text" className="flex-text text-muted">5 ways baby boomers are changing
                                        healthcare Starting in 2011, 3 million baby boomers each year reach retirement
                                        age....</p>
                                </div>
                            </article>

                            <article className="thumbnail item" itemScope="" itemType="http://schema.org/CreativeWork">
                                <a className="blog-thumb-img" href="/5-ways-baby-boomers-changing-healthcare/" title="">
                                    <img src="http://placehold.it/500x250" className="img-responsive"/>
                                </a>
                                <div className="caption">
                                    <h4 itemProp="headline">
                                        <a href="#" rel="bookmark">5 Ways Baby Boomers Are Changing Healthcare</a>
                                    </h4>
                                    <p itemProp="text" className="flex-text text-muted">5 ways baby boomers are changing
                                        healthcare Starting in 2011, 3 million baby boomers each year reach retirement
                                        age....</p>
                                </div>
                            </article>

                            <article className="thumbnail item" itemScope="" itemType="http://schema.org/CreativeWork">
                                <a className="blog-thumb-img" href="/5-ways-baby-boomers-changing-healthcare/" title="">
                                    <img src="http://placehold.it/500x250" className="img-responsive"/>
                                </a>
                                <div className="caption">
                                    <h4 itemProp="headline">
                                        <a href="#" rel="bookmark">5 Ways Baby Boomers Are Changing Healthcare</a>
                                    </h4>
                                    <p itemProp="text" className="flex-text text-muted">5 ways baby boomers are changing
                                        healthcare Starting in 2011, 3 million baby boomers each year reach retirement
                                        age....</p>
                                </div>
                            </article>

                            <article className="thumbnail item" itemScope="" itemType="http://schema.org/CreativeWork">
                                <a className="blog-thumb-img" href="/5-ways-baby-boomers-changing-healthcare/" title="">
                                    <img src="http://placehold.it/500x250" className="img-responsive"/>
                                </a>
                                <div className="caption">
                                    <h4 itemProp="headline">
                                        <a href="#" rel="bookmark">5 Ways Baby Boomers Are Changing Healthcare</a>
                                    </h4>
                                    <p itemProp="text" className="flex-text text-muted">5 ways baby boomers are changing
                                        healthcare Starting in 2011, 3 million baby boomers each year reach retirement
                                        age....</p>
                                </div>
                            </article>

                            <article className="thumbnail item" itemScope="" itemType="http://schema.org/CreativeWork">
                                <a className="blog-thumb-img" href="/5-ways-baby-boomers-changing-healthcare/" title="">
                                    <img src="http://placehold.it/500x250" className="img-responsive"/>
                                </a>
                                <div className="caption">
                                    <h4 itemProp="headline">
                                        <a href="#" rel="bookmark">5 Ways Baby Boomers Are Changing Healthcare</a>
                                    </h4>
                                    <p itemProp="text" className="flex-text text-muted">5 ways baby boomers are changing
                                        healthcare Starting in 2011, 3 million baby boomers each year reach retirement
                                        age....</p>
                                </div>
                            </article>

                            <article className="thumbnail item" itemScope="" itemType="http://schema.org/CreativeWork">
                                <a className="blog-thumb-img" href="/5-ways-baby-boomers-changing-healthcare/" title="">
                                    <img src="http://placehold.it/500x250" className="img-responsive"/>
                                </a>
                                <div className="caption">
                                    <h4 itemProp="headline">
                                        <a href="#" rel="bookmark">5 Ways Baby Boomers Are Changing Healthcare</a>
                                    </h4>
                                    <p itemProp="text" className="flex-text text-muted">5 ways baby boomers are changing
                                        healthcare Starting in 2011, 3 million baby boomers each year reach retirement
                                        age....</p>
                                </div>
                            </article>

                            <article className="thumbnail item" itemScope="" itemType="http://schema.org/CreativeWork">
                                <a className="blog-thumb-img" href="/5-ways-baby-boomers-changing-healthcare/" title="">
                                    <img src="http://placehold.it/500x250" className="img-responsive"/>
                                </a>
                                <div className="caption">
                                    <h4 itemProp="headline">
                                        <a href="#" rel="bookmark">5 Ways Baby Boomers Are Changing Healthcare</a>
                                    </h4>
                                    <p itemProp="text" className="flex-text text-muted">5 ways baby boomers are changing
                                        healthcare Starting in 2011, 3 million baby boomers each year reach retirement
                                        age....</p>
                                </div>
                            </article>

                            <article className="thumbnail item" itemScope="" itemType="http://schema.org/CreativeWork">
                                <a className="blog-thumb-img" href="/5-ways-baby-boomers-changing-healthcare/" title="">
                                    <img src="http://placehold.it/500x250" className="img-responsive"/>
                                </a>
                                <div className="caption">
                                    <h4 itemProp="headline">
                                        <a href="#" rel="bookmark">5 Ways Baby Boomers Are Changing Healthcare</a>
                                    </h4>
                                    <p itemProp="text" className="flex-text text-muted">5 ways baby boomers are changing
                                        healthcare Starting in 2011, 3 million baby boomers each year reach retirement
                                        age....</p>
                                </div>
                            </article>

                            <article className="thumbnail item" itemScope="" itemType="http://schema.org/CreativeWork">
                                <a className="blog-thumb-img" href="/5-ways-baby-boomers-changing-healthcare/" title="">
                                    <img src="http://placehold.it/500x250" className="img-responsive"/>
                                </a>
                                <div className="caption">
                                    <h4 itemProp="headline">
                                        <a href="#" rel="bookmark">5 Ways Baby Boomers Are Changing Healthcare</a>
                                    </h4>
                                    <p itemProp="text" className="flex-text text-muted">5 ways baby boomers are changing
                                        healthcare Starting in 2011, 3 million baby boomers each year reach retirement
                                        age....</p>
                                </div>
                            </article>
                        </div>
                        {/* #owl-carousel-2 */}
                        {/* Les boutons sont affichés par javascript
                        <div class="customNavigation">
                            <span class="pager-left"><a class="btn btn-link prev"><span class="fas fa-chevron-circle-left"></span></a></span>
                            <span class="pager-right"><a class="btn btn-link next"><span class="fas fa-chevron-circle-right"></span></a></span>
                        </div>
                        */}
                    </div>
                    {/* .container */}

                </section>


                {/* Parallax image 3 */}
                <div className="parallax parallax-main parallax3 parallax-plus-box">

                    <div className="card">
                        <h5 className="card-header">Rejoignez-nous</h5>
                        <div className="card-body">
                            <h5 className="card-title">Envie de participer à la documentation</h5>
                            <p className="card-text">
                                Cette plateforme de documentation est géré directement par les membres. Envie de
                                participer...
                            </p>
                            <p>
                                <a className="btn btn-primary" data-toggle="collapse" href="#multiCollapseSignUp2"
                                   role="button" aria-expanded="false" aria-controls="multiCollapseSignUp2">Devenir
                                    membre</a>
                                <button className="btn btn-primary" type="button" data-toggle="collapse"
                                        data-target="#multiCollapseLogin2" aria-expanded="false"
                                        aria-controls="multiCollapseLogin2">Login
                                </button>
                            </p>
                            <div className="row">
                                <div className="col">
                                    <div className="collapse multi-collapse" id="multiCollapseSignUp2">
                                        <h6>Inscription</h6>
                                        <form>
                                            <div className="form-row align-items-center">
                                                <div className="col-lg-6 my-1">
                                                    <label className="sr-only" htmlFor="inlineFormInputLastname">Nom</label>
                                                    <input type="text" className="form-control" id="inlineFormInputLastname"
                                                           placeholder="Dubois"/>
                                                </div>
                                                <div className="col-lg-6 my-1">
                                                    <label className="sr-only"
                                                           htmlFor="inlineFormInputFirstname">Prénom</label>
                                                    <input type="text" className="form-control"
                                                           id="inlineFormInputFirstname" placeholder="Jack"/>
                                                </div>
                                                <div className="col-lg-12 my-1">
                                                    <label className="sr-only" htmlFor="inlineFormInputGroupUsername">Adresse
                                                        e-mail</label>
                                                    <div className="input-group">
                                                        <div className="input-group-prepend">
                                                            <div className="input-group-text">@</div>
                                                        </div>
                                                        <input type="text" className="form-control"
                                                               id="inlineFormInputGroupUsername"
                                                               placeholder="mon-adresse@email.com"/>
                                                    </div>
                                                </div>
                                                <div className="col-lg-12 my-1">
                                                    <label className="sr-only" htmlFor="inputPassword6">Mot de passe</label>
                                                    <div className="input-group">
                                                        <div className="input-group-prepend">
                                                            <div className="input-group-text"><i
                                                                className="fas fa-unlock-alt"></i></div>
                                                        </div>
                                                        <input type="password" id="inputPassword6" className="form-control"
                                                               aria-describedby="passwordHelpBlock"
                                                               placeholder="Mot de passe"/>
                                                        <small id="passwordHelpBlock" className="form-text text-muted">
                                                            Your password must be 8-20 characters long, contain letters
                                                            and numbers, and must not contain spaces, special
                                                            characters, or emoji.
                                                        </small>
                                                    </div>
                                                </div>


                                                <div className="col-sm-12 my-1">
                                                    <div className="form-check">
                                                        <input className="form-check-input" type="checkbox"
                                                               id="autoSizingCheck1"/>
                                                        <label className="form-check-label" htmlFor="autoSizingCheck1">
                                                            Lu et approuvé les <a href="#">conditions générales
                                                            d'utilisation de l'application</a>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div className="col-auto my-1">
                                                    <button type="submit" className="btn btn-primary">Confirmer</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div className="col">
                                    <div className="collapse multi-collapse" id="multiCollapseLogin2">
                                        <h6>Login</h6>
                                        <form>
                                            <div className="form-row align-items-center">
                                                <div className="col-lg-12 my-1">
                                                    <label className="sr-only" htmlFor="inlineFormInputGroupUsername2">Adresse
                                                        e-mail</label>
                                                    <div className="input-group">
                                                        <div className="input-group-prepend">
                                                            <div className="input-group-text">@</div>
                                                        </div>
                                                        <input type="text" className="form-control"
                                                               id="inlineFormInputGroupUsername2"
                                                               placeholder="mon-adresse@email.com"/>
                                                    </div>
                                                </div>
                                                <div className="col-lg-12 my-1">
                                                    <label className="sr-only" htmlFor="inputPassword4">Mot de passe</label>
                                                    <div className="input-group">
                                                        <div className="input-group-prepend">
                                                            <div className="input-group-text"><i
                                                                className="fas fa-unlock-alt"></i></div>
                                                        </div>
                                                        <input type="password" id="inputPassword4" className="form-control"
                                                               aria-describedby="passwordHelpBlock2"
                                                               placeholder="Mot de passe"/>
                                                    </div>
                                                </div>
                                                <div className="col-sm-12 my-1">
                                                    <div className="form-check">
                                                        <input className="form-check-input" type="checkbox"
                                                               id="autoSizingCheck2"/>
                                                        <label className="form-check-label" htmlFor="autoSizingCheck2">
                                                            Se souvenir de moi
                                                        </label>
                                                    </div>
                                                </div>
                                                <div className="col-auto my-1">
                                                    <button type="submit" className="btn btn-primary">Confirmer</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            </Fragment>

    }
}