const intro = <div><h1>Conditions</h1>
<p>Comment faire en sorte que notre programme traite plusieurs cas différemment ? Avec des conditions.</p>
<p>Une condition se structure de manière simple : si (la condition est respectée), alors fait x actions. </p>
    <p>On peut aussi faire que en sorte que si (la condition n'est pas respectée), sinon on fait quelque chose d'autre.</p>
<p>Et on peut combiner les deux : si x, alors on fait une chose, sinon si y, alors on fait autre chose, sinon on fait une troisième chose.</p>
<p>C'est le cas dans cet exercice.</p>
<h2>Fizzbuzz</h2>
<p>Le principe est simple : On donne un nombre en entier, et :
<ul>
    <li>Si il est divisible par 3, on affiche Fizz.</li>
    <li>Si il est divisible par 5, on affiche Buzz.</li>
    <li>Si il est divisible par 3 et par 5, on affiche FizzBuzz.</li>
    <li>Sinon, on affiche le nombre.</li>
</ul>
    <p>Cela peut sembler un peu difficile pour une introduction aux conditions, donc ici le bloc conditions est déjà formatté d'une manière qui permet de résoudre le problème.</p>
<p>Vous n'avez pas besoin de le changer, mais une fois que vous avez réussi, n'hésitez pas à expérimenter !</p></p>
</div>;
ReactDOM.render(intro, document.getElementById('root'));
