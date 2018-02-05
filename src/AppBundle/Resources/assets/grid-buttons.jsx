import React from 'react';
import ReactDOM from 'react-dom';

class GridButtons extends React.Component {
 
  constructor(props) {
    super(props);
    this.state = {isPlayButtonToggleOn: false};

    // Necessario fare il bind del metodo per poter usare 
    // this all'interno del metodo stesso, altrimenti this è undefined.
    this.playArtistList = this.playArtistList.bind(this);
  }

  componentDidMount() {

  }

  componentWillUnmount() {

  }

  componentWillUpdate() {

  }

  componentDidUpdate() {
    
  }

  playArtistList() {
    this.setState((prevState, props) => ({
        isPlayButtonToggleOn: !prevState.isPlayButtonToggleOn
      })
    );
  }

	render() {
		return (
      <div style={{display:'flex'}}>
        <button>M</button>
        <button>E</button>
        <button onClick={this.playArtistList} style={{color:this.state.isPlayButtonToggleOn?'green':'#000'}}>
          {this.state.isPlayButtonToggleOn ? 'Now playing' : 'P'}
        </button>
      </div>
    );
	}
}

ReactDOM.render(<GridButtons/>, document.getElementById('react-grid-row-buttons'));