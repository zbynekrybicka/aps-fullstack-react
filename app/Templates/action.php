import axios from 'axios';
import { reducer } from '../store';
const {
    <?=$before; ?>,
    <?=$after; ?>,
    <?=$success; ?>,
    <?=$error; ?>

} = reducer.actions;

export default () => (dispatch, state) => {
<?php if ($store) { ?>
    const data = state().data.<?=$store; ?>
<?php } ?>

    dispatch(<?=$before; ?>());
    axios.<?=strtolower($method); ?>('<?=$url; ?>',
        <?=in_array(strtolower($method), ['post', 'put'])
            ? 'data, ' : ''; ?>{
        <?=$authorization
            ? 'headers: { Authorization: state().data.authToken },' : ''; ?>
        <?=in_array($method, ['get', 'delete'])
            ? 'params: data,' : ''; ?>

    })
        .then(({ data }) => {
            dispatch(<?=$success; ?>(data))
            dispatch(<?=$after; ?>())
        })
        .catch(({ response }) => {
            dispatch(<?=$error; ?>(response))
            dispatch(<?=$after; ?>())
        });
};
