import React from 'react';
import ReactDOM from 'react-dom';

class ArtistForm extends React.Component {
	constructor(props) {
	    super(props);
	    this.state = {
	    	formIsVisible: false,
	    	name: 'Nuovo artista'
	    };

	    this.handleNameChange = this.handleNameChange.bind(this);
	    this.handleSubmit = this.handleSubmit.bind(this);
  	}

	componentWillMount() {
	    this.initialState = this.state
	}

  	handleNameChange(event) {
    	this.setState({name: event.target.value});

  	}

  	handleSubmit(event) {
    	alert('An essay was submitted: ' + this.state.value);

   	 	event.preventDefault();
  	}

  	reste() {
		this.setState(this.initialState)
  	}

  	render() {
	    return (
	      <form onSubmit={this.handleSubmit} style={{display: this.state.formIsVisible ? 'block' : 'hide' }}>
		       <label>Nome *:</label>
		       <input type="text" value={this.state.name} onChange={this.handleNameChange} />
		       
		       <label>Note:</label>
		       <textarea />
	        
		       <input id="" type="submit" value="Salva" />
	      </form>
	    );
  	}	
}

export default ArtistForm;