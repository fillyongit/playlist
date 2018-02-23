import React from 'react';
import ReactDOM from 'react-dom';
import moment from 'moment';

class ArtistForm extends React.Component {
	constructor(props) {
	    super(props);

	    this.state = {
	    	formIsVisible: true,
	    	dataSaved: false,
	    	dataLoaded: false,
	    	data: {},
	    	error: null
	    };

	    this.handleChange = this.handleChange.bind(this);
	    this.handleSubmit = this.handleSubmit.bind(this);
	    this.handleClose = this.handleClose.bind(this);
  	}

	componentDidMount() {

		$('#' + this.props.formId).modal('show');

		// Ottiene alcuni dizionari.


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
	            dataLoaded: error ? false : true,
	            data: result,
	            error: error
	          });
	        },
	        // Note: it's important to handle errors here
	        // instead of a catch() block so that we don't swallow
	        // exceptions from actual bugs in components.
	        (error) => {
	          this.setState({
	            dataLoaded: false,
	            error: error.message
	          });
	        }
	    );
	}

	handleChange(e) {
	 	let obj = this.state.data;
	 	console.log(e.target.value);
	 	obj[e.target.name] = e.target.value;
    	this.setState({
    		data: obj
    	});
  	}

  	handleSubmit(e) {
  		// Validazione.
  		let $form = $('#artist-form');
        let isValid = true;
        if ($form.get(0).checkValidity() === false) {
          e.preventDefault();
          e.stopPropagation();
          isValid = false;
        }
        $form.addClass('was-validated');

        if (!isValid) {
        	return;
        }
console.log(this.state.data);
  		// Chiama php service per salvataggio dati.
		let data = new FormData($form.get(0));

		fetch(this.props.saveUrl, {
		  method: "POST",
		  body: data,
		  credentials: 'same-origin'
		})
		.then(res => res.json())
		.then(
	        (result) => {
	          let error = result.error || null;
	          this.setState({
	            dataSaved: error ? false : true,
	            error: error
	          });
	        },
	        // Note: it's important to handle errors here
	        // instead of a catch() block so that we don't swallow
	        // exceptions from actual bugs in components.
	        (error) => {
	          this.setState({
	            dataSaved: false,
	            error: error.message
	          });
	        }
		);

   	 	e.preventDefault();
  	}

	handleClose(e) {
		// Chiudo  il form di edit.
		$('#' + this.props.formId).modal('hide');

	    this.setState({
	        dataLoaded: false
	    });

		// Chiamo un metodo del componente padre.
		this.props.onFormClose();
	}

	getValue(fieldName, defaultVal = '') {
		return ((this.state.data.hasOwnProperty(fieldName) && this.state.data[fieldName]) || defaultVal);
	}

/*
	getRelCollectionId(fieldName) {
		let values = (this.state.data.hasOwnProperty(fieldName) && this.state.data[fieldName]) || [];
		let ids = [];
		values.forEach(function(el){
			ids.push(el.id);
		});
		return ids;
	}
*/

  	render() {
  		let content = null;
  		if (this.state.error) {
  			content = (
  				<div>
	      	 		<div className="modal-header"></div>
	      	 		<div className="modal-body">
							<div className="alert alert-warning" role="alert">{this.state.error}</div>
						</div>
						<div className="modal-footer">
			  			<button type="button" className="btn btn-secondary" onClick={this.handleClose}>{Translator.trans('close')}</button>
			  		</div>
		  		</div>
  			);
  		}  else if (!this.state.dataLoaded) {
	    	content = (
	      	 		<div>
		      	 		<div className="modal-header"></div>
		      	 		<div className="modal-body">
							<div className="alert alert-primary" role="alert">{Translator.trans('loading')}</div>
				  		</div>
				  	</div>
	    	);
	    } else {
	    	let dataSavedMsg = null;
	    	if (this.state.dataSaved) {
				dataSavedMsg = (
					<div className="alert alert-success" role="alert">
					 	{Translator.trans('form.save.ok')}
					</div>
				);
	    	}

		    content = (
		    	  	<div>
			      	  <div className="modal-header"></div>
				      <div className="modal-body">
				      	  {dataSavedMsg}
					      <form id="artist-form" className="needs-validation">
				      	  	<input type="hidden" name="id" value={this.getValue('id', 0)} />
				      	  	<div className="form-group">
					      		<label>{Translator.trans('form.name')} *:</label>
					     		<input type="text" name="name" 
					     			className="form-control" value={this.getValue('name')} 
					     			placeholder={Translator.trans('form.name_ph')} onChange={this.handleChange} required />
					     		 <div className="valid-feedback">{Translator.trans('form.name_required')}</div>
					       	</div>
				      	  	<div className="form-group">
					      		<label>{Translator.trans('form.surname')}:</label>
					     		<input type="text" name="surname" 
					     			className="form-control" value={this.getValue('surname')} 
					     			placeholder={Translator.trans('form.surname_ph')} onChange={this.handleChange} />
					       	</div>
				      	  	<div className="form-group">
					      		<label>{Translator.trans('form.birthdate')} *:</label>
					     		<input type="date" name="birthdate" 
					     			className="form-control" value={this.getValue('birthdate')} 
					     			placeholder={Translator.trans('form.birthdate_ph')} 
					     			onChange={this.handleChange} max={moment().format('YYYY-MM-DD')} required />
					     		<div className="valid-feedback">{Translator.trans('form.birthdate_required')}</div>
					       	</div>
					       	<div className="form-group">
					       		<label htmlFor="artist-form-records">{Translator.trans('form.records')}</label>
						       	<select name="records[]" id="artist-form-records" multiple={true} className="form-control"
						       		value={this.getValue('records')} onChange={this.handleChange}>
						       		{this.getValue('recordsEntities').map((record) => 
							    		<option key={record.id} value={record.id}>{record.name}</option>
							    	)}
						       	</select>
						    </div>
					       	<div className="form-group">
					      		<label>{Translator.trans('form.notes')}:</label>
					      		<textarea name="notes" className="form-control" />
					      	</div>
					      </form>
				      </div>
				      <div className="modal-footer">
					  	<button type="button" className="btn btn-secondary" onClick={this.handleClose}>{Translator.trans('close')}</button>
					  	<button type="button" className="btn btn-primary" onClick={this.handleSubmit}>{Translator.trans('salva')}</button>
					  </div>
					</div>
		    );
		}


		return (
		      <div className="modal fade" id={this.props.formId} tabIndex="-1" role="dialog" aria-labelledby="artist" aria-hidden="true">
		      	<div className="modal-dialog modal-lg">
			      <div className="modal-content">
						{content}
				   </div>
				</div>
		      </div>
		);

  	}	
}

export default ArtistForm;