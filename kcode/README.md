k-code
======

This is a self contained script to generate a "1up" animated graphic in a web browser whenever the user enters the Konami Code on a website that includes it. [See it In Action](http://trulove.cc/Bag-O-Tricks/kcode/)  
  
Building a Konami Code sensor was very little work, a whim I had after work one day, though capturing keystrokes (particularly of non-printing characters) outside of a field was something that was new to me.  
  
The generation of a purely HTML pixelated graphic surprised me in my immediately started duplicating functionality I used in the long outdated particle generator I wrote for my experimental game engine GEngHIS almost a decade ago.  
  
The experience inspired me to look over that old code, I was still a Prototype guy in those days, before jQuery change my life forever.  Examining the code I see that there are things I would do fundamentally different now, both to take advantage of modern APIs, and simply because my code is considerably more robust and cleverer after 8 years.  
  
Tonight I'm going to start work on "sParticles," a new JS particle generator, to recapture my original idea, fleshed out in a more object oriented and flexible methodology.  
  
Also... the number of divs a modern browser can comfortably handle compared to what they could back then? Woo! This could get interesting.