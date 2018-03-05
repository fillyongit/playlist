import React from 'react';
import ReactDOM from 'react-dom';


class LiveSearchListBoxField extends React.Component {
	constructor(props) {
	    super(props);

		this.state = {
			data: this.props.data
		};
	}

	componentDidMount() {
	}

	getData() {
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

	handleSearchChange(e) {
		// Chiama servizio per ottenere i valori sulla base del valore di ricerca.
	}

	handleChange(e) {
		console.log('change1');
		this.props.onChange(e);
	}

	render() {
		return (
			<div className="form-group">
				<label htmlFor={'listbox-' + this.props.name}>{Translator.trans('form.' + this.props.name)}</label>
				<br />
				<input type="text" name="search-box" onChange={this.handleSearchChange} />
				<select 
					value={this.props.value}
					name={this.props.name + '[]'} 
					id={'listbox-' + this.props.name} 
					multiple={true} 
					className="form-control"
		       		onChange={this.handleChange}>
		       		{this.state.data.map((value) => 
			    		<option key={value.id} value={value.id}>{value.name}</option>
			    	)}
		       	</select>
	       	</div>
		);
	}
}

export default LiveSearchListBoxField;