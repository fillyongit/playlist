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
	          let error = result.error || null;
	          this.setState({
	            dataLoaded: true,
	            data: result,
	            error: error
	          });

	          $('#' + this.props.formId).modal('show');
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
	    );
	}

	 handleChange(e) {
	 	let obj = this.state.data;
	 	obj[e.target.name] = e.target.value;
    	this.setState({
    		data: obj
    	});
  	}

  	handleSubmit(e) {
  		// Chiama php service per salvataggio dati.
   	 	e.preventDefault();
  	}

	handleClose(e) {
		$('#' + this.props.formId).modal('hide');

		// Chiamo un metodo del componente padre.
		//this.props.onFormClose();
	}

	getValue(fieldName, defaultVal = '') {
		return ((this.state.data.hasOwnProperty(fieldName) && this.state.data[fieldName]) || defaultVal);
	}

  	render() {
  		if (this.state.error) {
  			return <div className="alert alert-warning" role="alert">{this.state.error}</div>;
  		}  else if (!this.state.dataLoaded) {
	    	return <div className="alert alert-primary" role="alert">Loading...</div>;
	    } else {
		    return (
		      <div className="modal fade" id={this.props.formId} tabIndex="-1" role="dialog" aria-labelledby="artist" aria-hidden="true">
		      	<div className="modal-dialog modal-lg">
			      <div className="modal-content">
			      	  <div className="modal-header">

			      	  </div>
				      <div className="modal-body">
					      <form>
				      	  	<input type="hidden" name="id" value={this.getValue('id', 0)} />
				      	  	<div className="form-group">
					      		<label>Nome *:</label>
					     		<input type="text" name="name" 
					     			className="form-control" value={this.getValue('name')} 
					     			placeholder="Inserisci il nome" onChange={this.handleChange}  />
					       	</div>

					       	<div className="form-group">
					      		<label>Note:</label>
					      		<textarea name="notes" className="form-control" />
					      	</div>
					      </form>
				      </div>
				      <div className="modal-footer">
					  	<button type="button" className="btn btn-secondary" onClick={this.handleClose}>Close</button>
					  	<button type="button" className="btn btn-primary" onClick={this.handleSubmit}>Salva</button>
					  </div>
				  </div>
				</div>
		      </div>
		    );
		}
  	}	
}

export default ArtistForm;