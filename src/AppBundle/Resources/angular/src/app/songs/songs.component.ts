import { Component, OnInit } from '@angular/core';
import { Song } from '../song';
import { SONGS } from '../mock-songs';

@Component({
  selector: 'app-songs',
  templateUrl: './songs.component.html',
  styleUrls: ['./songs.component.css']
})
export class SongsComponent implements OnInit {

  songs: SONGS;

  constructor() { }

  ngOnInit() {
  }

}
