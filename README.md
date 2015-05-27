Loan
====

[![SensioLabsInsight](https://insight.sensiolabs.com/projects/d45eda4f-716b-46c4-9d1d-b683be19f98f/mini.png)](https://insight.sensiolabs.com/projects/d45eda4f-716b-46c4-9d1d-b683be19f98f)

# Installation

Open a command console, enter your project directory and execute the
following command to install dependencies :

```bash
    $ composer install
```

This command requires you to have Composer installed globally, as explained
in the ``installation chapter``_ of the Composer documentation.


# Using

## Calculation of monthly amount

```bash
    $ src/app.php app:payment
```

## Calculation of payment capacity

```bash
    $ src/app.php app:capacity
```

## Rate normal ?

For calculation bank uses generally : rate / 12. 
But normal rate is more complex calculation : (1 + rate)^1/12 - 1

With commands you can choice the rate which must be used !
