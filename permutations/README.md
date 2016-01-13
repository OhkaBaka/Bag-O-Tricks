Permutation Permutations
========================

I was given the following challenge:

Write a PHP program which prints all the permutations of a string in alphabetical order. Sorting should be performed in ascending order.  
Sample Input: Zu6  
Sample Output: 6Zu, 6uZ, Z6u, Zu6, u6Z, uZ6  
 
Scoring:  
IF / ELSE / ELSEIF = 2 points  
WHILE = 2 points + 2 points per iteration  
DO-WHILE = 2 points per iteration  
FOR = 2 points + 4 points per iteration  
FOREACH = 2 points + 1 point per iteration  
SWITCH = 4 points  

perm1.php
---------
	perm()
	4kb
	20 lines of code
Fairly ordinary code, elegant and simple.  It does the job.  Once I figured out how to do what I was doing, I ended up writing almost verbatim the code examples I found on the stack that are seeking the same goal.  I was unable to reduced the points on a 3 letter word to less than 20, and while the code is certainly acceptable for a real world situation, this was a challenge!

perm2.php
---------
	horror_perm()
	4 points
	~150kb
	~900 lines of code
I kept going back to the rules and looking at that SWITCH... 4 points, regardless of the options inside of it.  I devised a horribly offensive function that would generate all the possible permutations of a string and simply apply them as a filter.  I got as far as six characters long before writing in a default case that looped back and executed perm() for words that were longer.  (I was banking on the challenger not using predominantly long strings).  As long as the string is 1-6 characters, it executes in 4 points.

perm3.php
---------
	insane_perm()
	0 points
	~42Mb
	~36000 lines of code
I was considering ways of using try/catch for error control, and eliminanting "traditional" control structures altogether.  I slept on it, and woke up with the most terrible of solutions in my mind.  I realized my old friend **regex** was the answer.  regex, written correctly, wouldn't care how long a string was, and not error if it was too short. I wrote regex for any word up to 9 characters long.  I also took a gamble and abandoned the catch-all "if it is longer than x" hoping that it would never come up.  PHP regex can handle 99 backreferences, however, the size of the function gets exponentially larger with each extension.  
This is the most offensive piece of code I have ever written, it also destroyed the next closest competitor {(l^l)+2 points where l is the length of the word}
