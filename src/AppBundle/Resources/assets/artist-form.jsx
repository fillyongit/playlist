import React from 'react';
import ReactDOM from 'react-dom';

class ArtistForm extends React.Component {
	constructor(props) {
	    super(props);

	   	// Chiama php service per prendere i dati.
	    let stateObj = {};
	    stateObj['formIsVisible'] = true;
	    stateObj['id'] = this.props.id;
	    stateObj['name'] = 'Pearl Jam';

	    this.state = stateObj;

	    this.handleChange = this.handleChange.bind(this);
	    this.handleSubmit = this.handleSubmit.bind(this);
	    this.handleClose = this.handleClose.bind(this);



  	}

	componentWillMount() {
	    
	}

	 handleChange(e) {
	 	let obj = {};
	 	obj[e.target.name] = e.target.value;
    	this.setState(obj);
  	}

  	handleSubmit(e) {
   	 	e.preventDefault();
  	}

	handleClose(e) {
		// Chiamo un metodo del componente padre.
		console.log(this.state);

		// Chiama php service per salvataggio dati.

		this.props.onFormClose();
	}

	getValue(fieldName, defaultVal = '') {
		return (this.state[fieldName] || defaultVal);
	}

  	render() {
	    return (
	      <div>
		      <form onSubmit={this.handleSubmit}>
		      		<input type="hidden" name="id" value={this.getValue('id', 0)} />
			       <label>Nome *:</label>
			       <input type="text" name="name" value={this.getValue('name')} onChange={this.handleChange}  />
			       
			       <label>Note:</label>
			       <textarea name="notes" />
		        
			       <input type="submit" value="Salva" />
			       <button onClick={this.handleClose}>chiudi</button>
		      </form>
	      </div>
	    );
  	}	
}

export default ArtistForm;