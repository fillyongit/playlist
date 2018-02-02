import React from 'react';
import ReactDOM from 'react-dom';

class GridButtons extends React.Component {
 
  constructor(props) {
    super(props);
    // this.state = {date: new Date()};
  }

  componentDidMount() {

  }

  componentWillUnmount() {

  }

	render() {
		return (
      <div style={{display:'flex'}}>
        <div>M</div>
        <div>E</div>
      </div>
    );
	}
}

ReactDOM.render(<GridButtons/>, document.getElementById('react-grid-row-buttons'));