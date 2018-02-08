import React from 'react';
import ReactDOM from 'react-dom';

class ArtistForm extends React.Component {
	constructor(props) {
	    super(props);

	    this.state = {
	    	formIsVisible: true,
	    	dataLoaded: false,
	    	data: {},
	    	error: null
	    };

	    this.handleChange = this.handleChange.bind(this);
	    this.handleSubmit = this.handleSubmit.bind(this);
	    this.handleClose = this.handleClose.bind(this);
  	}

	componentDidMount() {
		// Chiama php service per prendere i dati.
		// this.props.id
		fetch(this.props.url, {
		  credentials: 'same-origin'  
		})
		.then(res => res.json())
		.then(
	        (result) => {
	          this.setState({
	            dataLoaded: true,
	            data: result
	          });
	        },
	        // Note: it's important to handle errors here
	        // instead of a catch() block so that we don't swallow
	        // exceptions from actual bugs in components.
	        (error) => {
	          this.setState({
	            dataLoaded: true,
	            error
	          });
	        }
	      )
	}

	 handleChange(e) {
	 	let obj = this.state.data;
	 	obj[e.target.name] = e.target.value;
    	this.setState({
    		data: obj
    	});
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
		return ((this.state.data.hasOwnProperty(fieldName) && this.state.data[fieldName]) || defaultVal);
	}

  	render() {
  		if (this.state.error) {
  			return <div className="alert alert-warning" role="alert">Impossibile recuperare il dato!</div>;
  		}  else if (!this.state.dataLoaded) {
	    	return <div className="alert alert-primary" role="alert">Loading...</div>;
	    } else {
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
}

export default ArtistForm;