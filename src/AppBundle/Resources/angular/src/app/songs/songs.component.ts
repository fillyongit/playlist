import { Component, OnInit } from '@angular/core';
import { Song } from '../song';
import { SONGS } from '../mock-songs';
// import { app } from '../namespace';

@Component({
  selector: 'app-songs',
  templateUrl: './songs.component.html',
  styleUrls: ['./songs.component.css']
})
export class SongsComponent implements OnInit {

  	songs = SONGS;

  	selectedSong: Song;

  	constructor() { 
  	}

  	ngOnInit() {
  		//console.log(SONGS);
  		// this.songs = SONGS;
  		console.log(app.userIsAuthenticated);
  	}

  	onSelect(song: Song): void {
  		this.selectedSong = song;
	}

}
