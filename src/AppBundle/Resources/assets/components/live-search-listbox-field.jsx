import React from 'react';
import ReactDOM from 'react-dom';

class LiveSearchListBoxField extends React.Component {
	constructor(props) {
	    super(props);

		// console.log(this.props.data);

		this.state = {
			data: this.props.data,
			searchFullfilled: false,
	    	error: null
		};

		this.handleChange = this.handleChange.bind(this);
		this.handleSearchChange = this.handleSearchChange.bind(this);
	}

	componentDidMount() {
	}

	doSearch(value) {
		var data = new FormData();
		data.append("search", value);
		data.append("token", this.props.token);

		// Chiama servizio per ottenere i valori sulla base del valore di ricerca.
		fetch(app.liveSearchUrl.replace(/__what__/, this.props.name), {
		  credentials: 'same-origin',
		  method: 'POST',
		  body: data
		})
		.then(res => res.json())
		.then(
			(result) => {
				if (!result.error) {
					let data = [];
					for (let i in result) {
						data[i] = JSON.parse(result[i]);
					}
					this.setState({
						searchFullfilled: true,
						data: data
					});
				} else {
					throw new Error(result.error);
				}
			},
			(error) => {
	          this.setState({
	            searchFullfilled: true,
	            error: error.message
	          });
	        }
		);
	}

	handleSearchChange(e) {
		if (e.target.value.length > 1) {
			const value = e.target.value;
			clearTimeout(this.searchTimeout);
			this.searchTimeout = setTimeout(
				() => {
					this.doSearch(value);
				},
				2000
			);
		}
	}

	handleChange(e) {
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