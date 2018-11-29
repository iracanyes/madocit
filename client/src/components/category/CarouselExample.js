import React, { Component, Fragment } from 'react';
import { connect } from 'react-redux';
import { Link } from 'react-router-dom';
import PropTypes from 'prop-types';
import { list, reset } from '../../actions/category/list';
import { success } from '../../actions/category/delete';
import { itemToLinks } from '../../utils/helpers';

// Carousel
import {
  Carousel,
  CarouselItem,
  CarouselControl,
  CarouselIndicators,
  CarouselCaption
} from 'reactstrap';

class CarouselExample extends Component {
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
    this.onExiting = this.onExiting.bind(this);
    this.onExited = this.onExited.bind(this);
  }

  /*
  componentWillMount() {
    this.props.list();
  }
  */

  componentDidMount() {
    this.props.list('/categories/');
  }


  componentWillReceiveProps(nextProps) {
    if (this.props.activeIndex !== nextProps.activeIndex) nextProps.list('/categories/'+nextProps.activeIndex && nextProps.activeIndex);
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
    console.log(this.props.data['hydra:member'][0].length);
    const nextIndex = this.state.activeIndex === (Math.ceil(this.props.data['hydra:member'][0].length / 9) - 1) ? 0 : this.state.activeIndex + 1;
    this.setState({activeIndex: nextIndex});

  }

  previous()
  {
    if(this.animating) return;

    const nextIndex = this.state.activeIndex === 0 ? (Math.ceil(this.props.data['hydra:member'][0].length / 9) - 1) : this.state.activeIndex -1;
    this.setState({activeIndex: nextIndex});
  }

  goToIndex(nexIndex)
  {
    if(this.animating) return;
    this.setState({ activeIndex: nexIndex });
  }


  render() {
    const { activeIndex } = this.state;


    this.props.data['hydra:member'] && console.log(this.props.data);


    const slides = this.props.data['hydra:member'] && this.props.data['hydra:member'][0].map((item) => {
      return (
          <CarouselItem
            onExiting={this.onExiting}
            onExited={this.onExited}
            key={item['@id']}
          >
            <img src={item.src} alt={item.alt} />
            <CarouselCaption captionText={item.name} captionHeader={item.name} />
            
          </CarouselItem>
      );
    });


    return <Fragment>
        <div>
      <h1>Nos catégories de documentation</h1>

      {this.props.loading && <div className="alert alert-info">Loading...</div>}
      {this.props.deletedItem && <div className="alert alert-success">{this.props.deletedItem['@id']} deleted.</div>}
      {this.props.error && <div className="alert alert-danger">{this.props.error}</div>}

      <p><Link to="create" className="btn btn-primary">Create</Link></p>

            {this.props.data['hydra:member'] &&
              <Carousel
                  activeIndex={activeIndex}
                  next={this.next}
                  previous={this.previous}
              >
                  <CarouselIndicators items={this.props.data['hydra:member'] && this.props.data['hydra:member'][0]}
                                      activeIndex={activeIndex} onClickHandler={this.goToIndex}/>
                  {slides}
                  <CarouselControl direction={"prev"} directionText={"Précédent"} onClickHandler={this.previous}/>
                  <CarouselControl direction={"next"} directionText={"Suivant"} onClickHandler={this.next}/>
              </Carousel>
            }

        {/*
        <table className="table table-responsive table-striped table-hover">
        <thead>
          <tr>
            <th>Id</th>
            <th>name</th>
            <th>description</th>
            <th>isValid</th>
            <th>dateCreated</th>
            <th>image</th>
            <th>themes</th>
            <th colSpan={2}></th>
          </tr>
        </thead>
        <tbody>
        {this.props.data['hydra:member'] && this.props.data['hydra:member'][0].map(item =>
          <tr key={item['@id']}>
            <th scope="row"><Link to={`show/${encodeURIComponent(item['@id'])}`}>{item['@id']}</Link></th>
            <td>{item['name'] ? itemToLinks(item['name']) : ''}</td>
            <td>{item['description'] ? itemToLinks(item['description']) : ''}</td>
            <td>{item['isValid'] ? itemToLinks(item['isValid']) : ''}</td>
            <td>{item['dateCreated'] ? itemToLinks(item['dateCreated']) : ''}</td>
            <td>{item['image'] ? itemToLinks(item['image']) : ''}</td>
            <td>{item['themes'] ? itemToLinks(item['themes']) : ''}</td>
            <td>
              <Link to={`show/${encodeURIComponent(item['@id'])}`}>
                <span className="fa fa-search" aria-hidden="true"/>
                <span className="sr-only">Show</span>
              </Link>
            </td>
            <td>
              <Link to={`edit/${encodeURIComponent(item['@id'])}`}>
                <span className="fa fa-pencil" aria-hidden="true"/>
                <span className="sr-only">Edit</span>
              </Link>
            </td>
          </tr>
        )}
        </tbody>
      </table>

      {this.pagination()}
      */}
    </div>
    </Fragment>;
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
    data: state.category.list.data,
    error: state.category.list.error,
    loading: state.category.list.loading,
    deletedItem: state.category.del.deleted,
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

export default connect(mapStateToProps, mapDispatchToProps)(CarouselExample);
