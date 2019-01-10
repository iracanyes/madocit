import React, {Component} from 'react';
import { connect } from 'react-redux';
import { Link } from 'react-router-dom';
import PropTypes from 'prop-types';
import { list, reset } from '../../actions/article/list';
import { success } from '../../actions/article/delete';
import { itemToLinks } from '../../utils/helpers';

import 'bootstrap/dist/css/bootstrap.css';

/* Carousel */
import {
  Card,
    CardHeader,
    CardBody,
    CardTitle,
    CardText,
    CardImg,
    Carousel,
    CarouselIndicators,
    CarouselItem,
    CarouselCaption,
    CarouselControl
} from 'reactstrap';

class CarouselRecent extends Component {
  static propTypes = {
    error: PropTypes.string,
    loading: PropTypes.bool.isRequired,
    data: PropTypes.object.isRequired,
    deletedItem: PropTypes.object,
    list: PropTypes.func.isRequired,
    reset: PropTypes.func.isRequired,
  };

  constructor(props)
  {
    super(props);
    this.state = { activeIndex: 0 };
    this.next = this.next.bind(this);
    this.previous = this.previous.bind(this);
    this.goToIndex = this.goToIndex.bind(this);
    this.onExiting= this.onExiting.bind(this);
    this.onExited = this.onExited.bind(this);
    this.createCarouselItems = this.createCarouselItems.bind(this);

  }

  componentWillMount() {
    this.props.list();

  }
  /*
  componentDidMount() {
    this.props.list();
  }
  */
  componentWillReceiveProps(nextProps) {
    //if (this.props.match.params.page !== nextProps.match.params.page) nextProps.list(nextProps.match.params.page && decodeURIComponent(nextProps.match.params.page));
  }

  componentWillUnmount() {
    this.props.reset();
  }

  onExiting()
  {
    this.animating = true;
  }

  onExited()
  {
    this.animating = false;
  }

  next()
  {
    if(this.animating) return;

    const nextIndex = this.state.activeIndex === (this.props.data['hydra:member'][0].length - 1) ? 0 : this.state.activeIndex + 1;
    this.setState({activeIndex: nextIndex});
  }

  previous()
  {
    if(this.animating) return;

    const nextIndex = this.state.activeIndex === 0 ? (this.props.data['hydra:member'][0].length - 1) : this.state.activeIndex - 1;
    this.setState({activeIndex: nextIndex});
  }

  goToIndex(nexIndex)
  {
    if(this.animating) return;
    this.setState({ activeIndex: nexIndex})
  }

  createCarouselItems()
  {
    let items = [];

    this.props.data['hydra:member'][0].map((value, index, tab) => {
      items.push(
          <CarouselItem
              onExiting={this.onExiting}
              onExited={this.onExited}
              key={'carouselItem' + index}
              className={""}
          >
            <Card>
              <CardImg  width={"100%"} src={"http://lorempixel.com/1200/980"}/>
              <CardBody>
                <CardTitle>
                  {value['title']}
                </CardTitle>
                <CardBody>
                  {value['articleBody'].slice(0, 250)}
                </CardBody>
              </CardBody>
            </Card>
          </CarouselItem>
      );
    });

    return items;
  }

  render() {

    const { activeIndex } = this.state;

    const items = this.props.data['hydra:member'] && this.createCarouselItems();



    return <section className={"carousel-articles"}>
      <h2>Articles récents</h2>

      {this.props.loading && <div className="alert alert-info">Loading...</div>}
      {this.props.deletedItem && <div className="alert alert-success">{this.props.deletedItem['@id']} deleted.</div>}
      {this.props.error && <div className="alert alert-danger">{this.props.error}</div>}

      {this.props.data['hydra:member'] &&
        <Carousel
            activeIndex={activeIndex}
            next={this.next}
            previous={this.previous}

        >
          {this.props.data['hydra:member'] && items}

          <CarouselIndicators items={this.props.data['hydra:member'] && items} activeIndex={activeIndex} onClickHandler={this.goToIndex}/>
          <CarouselControl direction={"prev"} directionText={"Précédent"} onClickHandler={this.previous}/>
          <CarouselControl direction={"next"} directionText={"Suivant"} onClickHandler={this.next}/>
        </Carousel>
      }


    </section>;
  }

  pagination() {
    const view = this.props.data['hydra:view'];
    if (!view) return;

    const {'hydra:first': first, 'hydra:previous': previous,'hydra:next': next, 'hydra:last': last} = view;

    return <nav aria-label="Page navigation">
        <Link to='.' className={`btn btn-primary${previous ? '' : ' disabled'}`}><span aria-hidden="true">&lArr;</span> First</Link>
        <Link to={!previous || previous === first ? '.' : encodeURIComponent(previous)} className={`btn btn-primary${previous ? '' : ' disabled'}`}><span aria-hidden="true">&larr;</span> Previous</Link>
        <Link to={next ? encodeURIComponent(next) : '#'} className={`btn btn-primary${next ? '' : ' disabled'}`}>Next <span aria-hidden="true">&rarr;</span></Link>
        <Link to={last ? encodeURIComponent(last) : '#'} className={`btn btn-primary${next ? '' : ' disabled'}`}>Last <span aria-hidden="true">&rArr;</span></Link>
    </nav>;
  }
}

const mapStateToProps = (state) => {
  return {
    data: state.article.list.data,
    error: state.article.list.error,
    loading: state.article.list.loading,
    deletedItem: state.article.del.deleted,
  };
};

const mapDispatchToProps = (dispatch) => {
  return {
    list: (page) => dispatch(list(page)),
    reset: () => {
      dispatch(reset());
      dispatch(success(null));
    },
  };
};

export default connect(mapStateToProps, mapDispatchToProps)(CarouselRecent);
