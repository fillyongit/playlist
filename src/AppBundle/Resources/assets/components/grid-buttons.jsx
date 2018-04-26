import React from 'react';
import ReactDOM from 'react-dom';
import ArtistForm from './artist-form.jsx';

import './grid-buttons.scss';

class GridButtons extends React.Component {
 
  constructor(props) {
    super(props);
    //console.log(this.props.id);
    this.state = {
      isPlayButtonToggleOn: false,
      isEditing: false
    };

    // Necessario fare il bind del metodo per poter usare 
    // this all'interno del metodo stesso, altrimenti this è undefined.
    this.playArtistList = this.playArtistList.bind(this);
    this.editArtist = this.editArtist.bind(this);
    this.handleFormClose = this.handleFormClose.bind(this);
  }

  componentDidMount() {

  }

  componentWillUnmount() {

  }

  componentWillUpdate() {

  }

  componentDidUpdate() {
    
  }

  editArtist(e) {
    this.setState({
        isEditing: true
    });
  }

  playArtistList(e) {
    this.setState((prevState, props) => ({
        isPlayButtonToggleOn: !prevState.isPlayButtonToggleOn
      })
    );
  }

  handleFormClose(){
    this.setState({
        isEditing: false
    });
  }

	render() {
    let form = null;
    let formId = 'entity-form-' + this.props.id;
    if (this.state.isEditing) {
      form = <ArtistForm id={this.props.id}
       onFormClose={this.handleFormClose} 
       formId={formId} token={this.props.token} />;
    } else {
      form = null;
    }

		return (
      <div>
        <div className="grid-buttons">
          {app.userIsEditor ? (<i className="btn fas fa-pencil-alt fa-lg" onClick={this.editArtist}></i>) : ''}
          <i className="btn fas fa-trash fa-lg"></i>
          <i className={'btn fas ' + (this.state.isPlayButtonToggleOn ? 'fa-headphones' : 'fa-play') + ' fa-lg'} 
            onClick={this.playArtistList}></i>
        </div>
        {form}
      </div>
    );
	}
}

export default GridButtons;