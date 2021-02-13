import axios from 'axios';
import { reducer } from '../store';
const {
    <?=$before; ?>,
    <?=$after; ?>,
    <?=$success; ?>,
    <?=$error; ?>

} = reducer.actions;

export default () => (dispatch, state) => {
    const data = state().data.<?=$store; ?>

    dispatch(<?=$before; ?>());
    axios.<?=$method; ?>('<?=$url; ?>',
        <?=in_array($method, ['post', 'put'])
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
