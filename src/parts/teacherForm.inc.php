
<!-- 
 * 
 * ETML
 * Auteur : Kathleen Lu
 * Date : 26.10.23
 * Description : Formulaire vide si on veut ajouter un enseignant, sinon complété avec les informations de l'enseignant si on veut les modifier
 -->
<p>
    <input type="radio" id="gender1" name="gender" value="m" <?php if ($userData["gender"] === "m") { echo "checked";} ?>>
    <label for="gender1">Homme</label>
    <input type="radio" id="gender2" name="gender" value="w" <?php if ($userData["gender"] === "w") { echo "checked";} ?>>
    <label for="gender2">Femme</label>
    <input type="radio" id="gender3" name="gender" value="o" <?php if ($userData["gender"] === "o") { echo "checked";} ?>>
    <label for="gender3">Autre</label>
</p>
<p>
    <label for="lastName">Nom :</label>
    <input type="text" name="lastName" id="lastName" value="<?=$userData["lastName"];?>">
</p>
<p>
    <label for="firstName">Prénom :</label>
    <input type="text" name="firstName" id="firstName" value="<?=$userData["firstName"];?>">
</p>
<p>
    <label for="nickname">Surnom :</label>
    <input type="text" name="nickname" id="nickname" value="<?=$userData["nickname"];?>">
</p>
<p>
    <label for="origin">Origine :</label>
    <textarea name="origin" id="origin" rows="5" cols="35"><?=$userData["origin"];?></textarea>
</p>
<p>
    <label style="display: none" for="section"></label>
    <select name="section" id="section">
        <option value="">Section</option>
        <?php
        // html pour afficher toutes sections
        $html ="";

        // Parcoure le tableau des sections pour générer le html pour chaque section
        foreach ($sections as $section) {
            $html .= '<option value="' . $section["idSection"] . '" ';
            
            if ($section["idSection"] === $userData["idSection"]) {
                $html .= 'selected';
            }

            $html .= '>' . $section["secName"] . '</option>';
        }

        echo $html;
        ?>
    </select>
</p>