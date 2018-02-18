> GLI-SA technical assesment by Elizabeth Meyer 18 February 2017

**Working example implemented here: http://www.lightinside.co.za/elizabethmeyer/lotto-draw-machine/**

_I misread the original instructions as "The application should be a single page **application**". So that's what I did. At least it gave me a good excuse to get to know and play with Vue.js. ~Elizabeth_

# Project Information
**This is a Vue Project with a PHP API for writing to CSV.**

The working distributable can be found in the **dist** folder and the PHP API for writing to CSV in the **_php** folder.

# Assesment Instructions: Lotto Draw Machine

The application should be a single page, with two buttons. The buttons consist of a Play button
and an Export All button.

**Explanation:**

- There are between 40 and 49 balls in a main set of balls.
- There are between 5 and 7 balls drawn from the main set.
- There are up between 5 and 49 balls in a powerball set.
- There are between [0 to 3] number of balls drawn from a powerball set.

When the ‘Play’ button is pressed ,the correct number of balls are chosen from the ball set and
the powerball set. This combination is displayed, showing the both the balls and the
powerball(s) if there are any.

The 10 most recently drawn combinations must also be shown on the screen, along with the
time of each of these draws.

The last 100 winning combinations and their draw times need to be persisted to disk.

When ‘Export All’ is pressed, all of the previous drawn combinations from the persistence store
are presented to the user as a CSV file.

You have the freedom to design the program as you like; however, the draw mechanism itself
needs be designed in an OOP style, with a primary public method named `draw()`.

Make sure to apply best practices.
